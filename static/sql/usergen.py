#!/usr/bin/python3

# Script per creare utenti casuali, benchmark per il login

from hashlib import md5
from random import randint, randbytes
from string import ascii_letters


def gen_ascii_string(length, allowed=ascii_letters + "0123456789"):
    """Generate a string of specified length using only allowed ASCII characters."""
    out = ""
    for _ in range(length):
        out += allowed[randint(0, len(allowed)-1)]
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
            gen_ascii_string(
                randint(5, 13),
                # Unix dictionary frequency più realistico? (https://mdickens.me/typing/letter_frequency.html)
                allowed=
                "e" * 26
                + "i" * 25
                + "a" * 24
                + "o" * 23
                + "r" * 22
                + "n" * 21
                + "t" * 20
                + "s" * 19
                + "l" * 18
                + "c" * 17
                + "u" * 16
                + "p" * 15
                + "m" * 14
                + "d" * 13
                + "h" * 12
                + "y" * 11
                + "g" * 10
                + "b" * 9
                + "f" * 8
                + "v" * 7
                + "k" * 6
                + "w" * 5
                + "z" * 4
                + "x" * 3
                + "q" * 2
                + "j0123456789-_+"
            )
        )
        i += 1
        print(f"\r  usernames: \x1B[92m{i}/{TO_GENERATE}\x1B[0m", end="")
    print()
    i = 0
    while len(list(new_usersalts)) < TO_GENERATE:
        new_usersalts.add(randbytes(16).hex())
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
