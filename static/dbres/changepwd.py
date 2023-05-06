#!/usr/bin/python3

# Script di cambio password utente (usare anche per il proprio account admin)

from hashlib import md5
from random import randbytes
import sys

if __name__ == "__main__":
    username, password = False, False
    if len(sys.argv) == 3:
        username = sys.argv[1]
        password = sys.argv[2]
    else:
        try:
            username = input("Matching username: ")
            password = input("New password: ")
            while password != input("Retype password: "):
                print("Try again!")
        except KeyboardInterrupt:
            sys.exit("KeyboardInterrupt\n")

    if username and password:
        salt = randbytes(16).hex()
        md5saltedpwd = md5(bytes(password + salt, encoding="ascii")).hexdigest()
        with open("changepwd-out.sql", "w") as output:
            output.write(
                "UPDATE utente SET password_md5_salt='"
                + md5saltedpwd
                + "', salt='"
                + salt
                + "' WHERE username='"
                + username
                + "';"
            )
