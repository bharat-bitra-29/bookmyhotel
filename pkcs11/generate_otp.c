#include "pkcs11_common.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

static unsigned int dynamic_truncate_sha256(unsigned char *hmac) {
    int offset = hmac[31] & 0x0f;
    return ((hmac[offset] & 0x7f) << 24) |
           ((hmac[offset+1] & 0xff) << 16) |
           ((hmac[offset+2] & 0xff) << 8) |
           (hmac[offset+3] & 0xff);
}

unsigned int gen_otp(CK_FUNCTION_LIST_PTR p11, CK_SESSION_HANDLE session,
                     CK_OBJECT_HANDLE hKey, long timestep) {

    CK_MECHANISM mech = { CKM_SHA256_HMAC, NULL, 0 };

    unsigned char msg[8];
    for (int i = 7; i >= 0; i--) {
        msg[i] = timestep & 0xff;
        timestep >>= 8;
    }

    unsigned char hmac[32];
    CK_ULONG hmacLen = sizeof(hmac);

    CK_RV rv = p11->C_SignInit(session, &mech, hKey);
    if (rv != CKR_OK) return 0;

    rv = p11->C_Sign(session, msg, 8, hmac, &hmacLen);
    if (rv != CKR_OK) return 0;

    unsigned int bin = dynamic_truncate_sha256(hmac);
    return bin % 1000000;
}

int main(int argc, char *argv[]) {
    if (argc != 2) {
        printf("USAGE: %s <user_id>\n", argv[0]);
        return 1;
    }

    char label[64];
    snprintf(label, sizeof(label), "USER_%s_HMAC", argv[1]);

    CK_FUNCTION_LIST_PTR p11 = pkcs11_init();
    if (!p11) return 1;

    CK_SLOT_ID slot = find_slot(p11);

    CK_SESSION_HANDLE session;
    CK_RV rv = p11->C_OpenSession(slot, CKF_SERIAL_SESSION | CKF_RW_SESSION, NULL, NULL, &session);
    if (rv != CKR_OK) { printf("OPEN_SESSION_FAIL\n"); return 1; }

    rv = p11->C_Login(session, CKU_USER, (CK_UTF8CHAR *)TOKEN_PIN, strlen(TOKEN_PIN));
    if (rv != CKR_OK && rv != CKR_USER_ALREADY_LOGGED_IN) { printf("LOGIN_FAIL\n"); return 1; }

    CK_OBJECT_HANDLE hKey;
    CK_OBJECT_CLASS cls = CKO_SECRET_KEY;
    CK_ATTRIBUTE findTemplate[] = {
        {CKA_LABEL, label, strlen(label)},
        {CKA_CLASS, &cls, sizeof(cls)}
    };

    CK_ULONG found = 0;
    p11->C_FindObjectsInit(session, findTemplate, 2);
    p11->C_FindObjects(session, &hKey, 1, &found);
    p11->C_FindObjectsFinal(session);

    if (!found) { printf("KEY_NOT_FOUND\n"); return 1; }

    unsigned long now = time(NULL) / 30;
    unsigned int otp = gen_otp(p11, session, hKey, now);

    printf("%06u\n", otp);   //
    return 0;
}
