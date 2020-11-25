CREATE DATABASE cl_chat;

CREATE TABLE IF NOT EXISTS u_login (
    id int(11) NOT NULL AUTO_INCREMENT,
    user_code int(32) NOT NULL DEFAULT '0',
    username char(128) NOT NULL DEFAULT '0',
    password blob NOT NULL DEFAULT '0',
    email varchar(255) NOT NULL DEFAULT '0',
    name text(100) NOT NULL DEFAULT '0',
    lname text(100) NOT NULL DEFAULT '0',
    age int(11) NOT NULL DEFAULT '0',
    sex int(32) NOT NULL DEFAULT '0',
    country text(50) NOT NULL DEFAULT '0',
    state text(50) NOT NULL DEFAULT '0',
    bio varchar(500) NOT NULL DEFAULT '0',
    hobby text(100) NOT NULL DEFAULT '0',
    photo varchar(255) NOT NULL DEFAULT '0',
    isActive int(32) NOT NULL DEFAULT '0',
    roleid int(32) NOT NULL DEFAULT '0',
    vis int(32) NOT NULL DEFAULT '0',
    checking tinyint(4) NOT NULL DEFAULT '0',
    type int(32) NOT NULL DEFAULT '0',
    login_at time NOT NULL, 
    logout_at time NOT NULL,
    status text(50) NOT NULL DEFAULT '0',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE(user_code),
    INDEX(email),
    INDEX(type)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS u_guest(
    id int(11) NOT NULL AUTO_INCREMENT,
    guest_code int(11) NOT NULL,
    username char(128) NOT NULL,
    isActive int(32) NOT NULL,
    type tinyint(4) NOT NULL,
    login_at datetime NOT NULL,
    logout_at datetime NOT NULL,
    status text(50) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(guest_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS c_search(
    id int(11) NOT NULL AUTO_INCREMENT,
    user_code int(32) NOT NULL,
    username char(128) NOT NULL,
    bio varchar(500) NOT NULL, 
    hobby text(100) NOT NULL,
    country text(50) NOT NULL,
    state text(50) NOT NULL,
    age int(11) NOT NULL,
    sex int(32) NOT NULL DEFAULT '0',
    photo varchar(255) NOT NULL,
    scope text(100) NOT NULL DEFAULT '0',
    isActive int(32) NOT NULL,
    roleid int(32) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(user_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS u_banned (
    id int(11) NOT NULL AUTO_INCREMENT,
    bann_code int(32) NOT NULL,
    user_banned int(32) NOT NULL,
    bannator_user int(32) NOT NULL,
    banned_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    de_bennaed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE(bann_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS t_session (
    id int(11) NOT NULL AUTO_INCREMENT,
    session_code int(32) NOT NULL,
    session_name varchar(128) NOT NULL,
    session_token varchar(128) NOT NULL,
    session_usercode int(32) NOT NULL,
    session_ip char(100) NOT NULL,
    session_mac char(100) NOT NULL,
    session_localization varchar(255) NOT NULL,
    session_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    session_start time NOT NULL,
    session_end time NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(session_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS m_coder (
    id int(11) NOT NULL AUTO_INCREMENT,
    code int(32) NOT NULL,
    name text(128) NOT NULL,
    mix text(50) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS s_email(
    id int(11) NOT NULL AUTO_INCREMENT,
    email_code int(32) NOT NULL,
    receiver varchar(255) NOT NULL,
    subject char(100) NOT NULL,
    body varchar(1000) NOT NULL,
    sender varchar(255) NOT NULL,
    mac_adress char(128) NOT NULL,
    ip_adress char(128) NOT NULL,
    sended_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id),
    UNIQUE(email_code)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE s_email
ADD FOREIGN KEY(receiver) REFERENCES u_login(email) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE u_login 
ADD FOREIGN KEY(sex) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(isActive) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(roleid) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(vis) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(type) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE t_session
ADD FOREIGN KEY(session_usercode) REFERENCES u_login(user_code) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE u_banned 
ADD FOREIGN KEY(user_banned) REFERENCES u_login(user_code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(bannator_user) REFERENCES u_login(user_code) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE c_search
ADD FOREIGN KEY(sex) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(isActive) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(roleid) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE u_guest
ADD FOREIGN KEY(isActive) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE;