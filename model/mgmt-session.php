<?php
    define("DSSNAME", "dssessionid");
    define("DSSEXPIRE", 518401);

    // Usare session_start() e session_destroy() assieme a queste funzioni

    function create_dssessionid() {
        session_name(DSSNAME);
        // Attiviamo httpOnly, per prevenire accesso via JS
        session_set_cookie_params(DSSEXPIRE, "/", "", false, true);
        // Generiamo un ID di sessione di 64 byte: i primi 32 sono hash dell'IP remoto, e gli ultimi 32 sono casuali
        if(!isset($_COOKIE[DSSNAME])) {
            $sessfromip = md5(strtr($_SERVER['REMOTE_ADDR'], ".:/", "=")) 
                        .bin2hex(openssl_random_pseudo_bytes(16));
            session_id($sessfromip);
        }  
    }

    function check_dssessionid() {
        // vs. Session Hijacking (è ancora possibile, non ci sono ancora controlli CSRF)
        //return (md5(strtr($_SERVER['REMOTE_ADDR'], ".:/", "=")) === substr(session_id(), 0, 32)); // non funziona con session_id?
        if(!isset($_COOKIE[DSSNAME]))
            return false;
        return (md5(strtr($_SERVER['REMOTE_ADDR'], ".:/", "=")) === substr($_COOKIE[DSSNAME], 0, 32));
    }

    function delete_dssessionid() {
        unset($_COOKIE[DSSNAME]);
        setcookie(DSSNAME, null, 1, "/");
    }
?>