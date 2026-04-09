#include "pkcs11_common.h"
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int main(int argc, char *argv[]) {
    if (argc != 2) {
        printf("Usage: %s <user_id>\n", argv[0]);
        return 1;
    }

    char label[64];
    snprintf(label, sizeof(label), "USER_%s_HMAC", argv[1]);

    CK_FUNCTION_LIST_PTR p11 = pkcs11_init();
    if (!p11) return 1;

    CK_SLOT_ID slot = find_slot(p11);

    CK_SESSION_HANDLE session;
    CK_RV rv = p11->C_OpenSession(slot, CKF_SERIAL_SESSION | CKF_RW_SESSION, NULL, NULL, &session);
    if (rv != CKR_OK) {
        printf("OPEN_SESSION_FAIL: 0x%lx\n", rv);
        return 1;
    }

    rv = p11->C_Login(session, CKU_USER, (CK_UTF8CHAR *)TOKEN_PIN, strlen(TOKEN_PIN));
    if (rv != CKR_OK && rv != CKR_USER_ALREADY_LOGGED_IN) {
        printf("LOGIN_FAIL: 0x%lx\n", rv);
        return 1;
    }

    CK_OBJECT_CLASS keyClass = CKO_SECRET_KEY;
    CK_KEY_TYPE keyType = CKK_GENERIC_SECRET;
    CK_BBOOL trueVal = CK_TRUE;
    CK_ULONG keyLen = 32; 

    CK_BBOOL falseVal = CK_FALSE;

    CK_ATTRIBUTE template[] = {
        {CKA_CLASS, &keyClass, sizeof(keyClass)},
        {CKA_KEY_TYPE, &keyType, sizeof(keyType)},
        {CKA_VALUE_LEN, &keyLen, sizeof(keyLen)},
        {CKA_LABEL, label, strlen(label)},
        {CKA_TOKEN, &trueVal, sizeof(trueVal)},
        {CKA_SIGN, &trueVal, sizeof(trueVal)},
        {CKA_VERIFY, &trueVal, sizeof(trueVal)},
        {CKA_SENSITIVE, &trueVal, sizeof(trueVal)},     
        {CKA_EXTRACTABLE, &falseVal, sizeof(falseVal)}   
    };

    CK_OBJECT_HANDLE key;
    CK_MECHANISM mech = { CKM_GENERIC_SECRET_KEY_GEN, NULL, 0 };

    rv = p11->C_GenerateKey(session, &mech, template, 7, &key);
    if (rv != CKR_OK) {
        printf("KEY_GEN_FAIL: 0x%lx\n", rv);
        return 1;
    }

    printf("KEY_CREATED_OK\n");
    p11->C_CloseSession(session);
    return 0;
}
