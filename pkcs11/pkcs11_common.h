#ifndef PKCS11_COMMON_H
#define PKCS11_COMMON_H

#include <pkcs11.h>

#define PKCS11_LIB "/usr/lib/x86_64-linux-gnu/softhsm/libsofthsm2.so"

#define TOKEN_PIN   "291929"
#define TOKEN_LABEL "HOTEL_OTP_TOKEN"

CK_FUNCTION_LIST_PTR pkcs11_init();
CK_SLOT_ID find_slot(CK_FUNCTION_LIST_PTR p11);
CK_OBJECT_HANDLE find_key(CK_FUNCTION_LIST_PTR p11, CK_SESSION_HANDLE session, const char *label);

#endif
