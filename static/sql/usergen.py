#!/usr/bin/python3

# Script per creare utenti casuali, benchmark per il login

from hashlib import md5
from random import randint
from string import ascii_letters


def gen_ascii_string(length, allowed=ascii_letters + "0123456789!$%&()=@#*+-_"):
    """Generate a string of specified length using only allowed ASCII characters."""
    out = ""
    for _ in range(length):
        while True:
            char = randint(32, 127).to_bytes(1, "big").decode("ascii")
            if char.isalnum() or char in allowed:
                out += char
                break
    return out


if __name__ == "__main__":
    TO_GENERATE = 32768
    DEFAULT_PASSWORD = "password"
    print(f"Generating {TO_GENERATE} accounts...")
    new_usernames, new_usersalts, new_emails = set(), set(), set()
    new_md5salted = []
    i = 0
    while len(list(new_usernames)) < TO_GENERATE:
        new_usernames.add(
            gen_ascii_string(randint(5, 32), allowed=ascii_letters + "0123456789-_+")
        )
        i += 1
        print(f"\r  usernames: \x1B[92m{i}/{TO_GENERATE}\x1B[0m", end="")
    print()
    i = 0
    while len(list(new_usersalts)) < TO_GENERATE:
        new_usersalts.add(gen_ascii_string(randint(8, 32)))
        i += 1
        print(f"\r  salts: \x1B[92m{i}/{TO_GENERATE}\x1B[0m", end="")
    print()
    i = 0
    while len(list(new_emails)) < TO_GENERATE:
        new_emails.add(
            gen_ascii_string(10, allowed=ascii_letters) + "@noreply.usergen.local"
        )
        i += 1
        print(f"\r  emails: \x1B[92m{i}/{TO_GENERATE}\x1B[0m", end="")
    print()
    i = 0
    for salt in list(new_usersalts):
        new_md5salted.append(
            md5(bytes(DEFAULT_PASSWORD + salt, encoding="ascii")).hexdigest()
        )
        i += 1
        print(f"\r  salted password hashes: \x1B[92m{i}/{TO_GENERATE}\x1B[0m", end="")
    print()

    print(f"\nCreating file with {TO_GENERATE} accounts...")
    new_users = list(
        zip(
            list(new_usernames),
            list(new_emails),
            new_md5salted,
            list(new_usersalts),
            [0] * TO_GENERATE,
        )
    )

    with open("usergen-out.sql", "w") as output:
        output.write("INSERT INTO utente VALUES\n")
        i = 0
        for user in new_users:
            output.write(
                f"  ('{user[0]}', '{user[1]}', '{user[2]}', '{user[3]}', {user[4]})"
            )
            i += 1
            print(f"\r  insert tuples: \x1B[92m{i}/{TO_GENERATE}\x1B[0m", end="")
            if i == TO_GENERATE:
                output.write(";\n")
            else:
                output.write(",\n")

    print("\n\nDone.")
