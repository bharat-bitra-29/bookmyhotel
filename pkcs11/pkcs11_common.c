#include "pkcs11_common.h"
#include <dlfcn.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

CK_FUNCTION_LIST_PTR pkcs11_init() {
    void *handle = dlopen(PKCS11_LIB, RTLD_NOW);
    if (!handle) {
        printf("dlopen failed: %s\n", dlerror());
        return NULL;
    }

    CK_C_GetFunctionList getFunctionList =
        (CK_C_GetFunctionList)dlsym(handle, "C_GetFunctionList");

    if (!getFunctionList) {
        printf("dlsym failed\n");
        return NULL;
    }

    CK_FUNCTION_LIST_PTR p11 = NULL;
    CK_RV rv = getFunctionList(&p11);
    if (rv != CKR_OK || !p11) {
        printf("C_GetFunctionList failed: 0x%lx\n", rv);
        return NULL;
    }

    rv = p11->C_Initialize(NULL);
    if (rv != CKR_OK && rv != CKR_CRYPTOKI_ALREADY_INITIALIZED) {
        printf("C_Initialize failed: 0x%lx\n", rv);
        return NULL;
    }

    return p11;
}

CK_SLOT_ID find_slot(CK_FUNCTION_LIST_PTR p11) {
    CK_ULONG count = 0;
    CK_RV rv;

    rv = p11->C_GetSlotList(CK_TRUE, NULL, &count);
    if (rv != CKR_OK || count == 0) {
        printf("No slots found: 0x%lx\n", rv);
        exit(1);
    }

    CK_SLOT_ID *slots = malloc(sizeof(CK_SLOT_ID) * count);
    rv = p11->C_GetSlotList(CK_TRUE, slots, &count);
    if (rv != CKR_OK) {
        printf("C_GetSlotList failed: 0x%lx\n", rv);
        exit(1);
    }

    CK_SLOT_ID slot = slots[0];
    free(slots);
    return slot;
}

CK_OBJECT_HANDLE find_key(CK_FUNCTION_LIST_PTR p11,
                          CK_SESSION_HANDLE session,
                          const char *label)
{
    CK_OBJECT_HANDLE hKey = CK_INVALID_HANDLE;
    CK_OBJECT_CLASS cls = CKO_SECRET_KEY;

    CK_ATTRIBUTE template[] = {
        {CKA_LABEL, (CK_VOID_PTR)label, strlen(label)},
        {CKA_CLASS, &cls, sizeof(cls)}
    };

    CK_ULONG found = 0;

    CK_RV rv = p11->C_FindObjectsInit(session, template, 2);
    if (rv != CKR_OK) {
        printf("C_FindObjectsInit failed: 0x%lx\n", rv);
        return CK_INVALID_HANDLE;
    }

    rv = p11->C_FindObjects(session, &hKey, 1, &found);
    p11->C_FindObjectsFinal(session);

    if (rv != CKR_OK || found == 0) {
        return CK_INVALID_HANDLE;
    }

    return hKey;
}
