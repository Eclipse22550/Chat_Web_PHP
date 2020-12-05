CREATE DATABASE chat;

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
    warning tinyint(4) NOT NULL DEFAULT '0',
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
    guest_code int(11) NOT NULL DEFAULT '0',
    username char(128) NOT NULL DEFAULT '0',
    isActive int(32) NOT NULL DEFAULT '0',
    type tinyint(4) NOT NULL DEFAULT '0',
    warning tinyint(4) NOT NULL DEFAULT '0',
    login_at datetime NOT NULL,
    logout_at datetime NOT NULL,
    status text(50) NOT NULL DEFAULT '0',
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
    type text(100) NOT NULL DEFAULT '0',
    vis int(32) NOT NULL DEFAULT '0',
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

CREATE TABLE c_group(
    id int(11) not null AUTO_INCREMENT,
    group_code int(32) not null,
    user_1 int(32) not null,
    user_2 int(32) not null,
    user_3 int(32) not null,
    user_4 int(32) not null,
    user_5 int(32) not null,
    user_6 int(32) not null,
    user_7 int(32) not null,
    user_8 int(32) not null,
    user_9 int(32) not null,
    user_10 int(32) not null,
    user_11 int(32) not null,
    user_12 int(32) not null,
    user_13 int(32) not null,
    user_14 int(32) not null,
    user_15 int(32) not null,
    user_16 int(32) not null,
    user_17 int(32) not null,
    user_18 int(32) not null,
    user_19 int(32) not null,
    user_20 int(32) not null,
    user_21 int(32) not null,
    user_22 int(32) not null,
    user_23 int(32) not null,
    user_24 int(32) not null,
    user_25 int(32) not null,
    user_26 int(32) not null,
    user_27 int(32) not null,
    user_28 int(32) not null,
    user_29 int(32) not null,
    user_30 int(32) not null,
    status text(25) not null,
    created_at TIMESTAMP not null,
    PRIMARY KEY(id),
    UNIQUE(group_code),
    INDEX(user_1),
    INDEX(user_2),
    INDEX(user_3),
    INDEX(user_4),
    INDEX(user_5),
    INDEX(user_6),
    INDEX(user_7),
    INDEX(user_8),
    INDEX(user_9),
    INDEX(user_10),
    INDEX(user_11),
    INDEX(user_12),
    INDEX(user_13),
    INDEX(user_14),
    INDEX(user_15),
    INDEX(user_16),
    INDEX(user_17),
    INDEX(user_18),
    INDEX(user_19),
    INDEX(user_20),
    INDEX(user_21),
    INDEX(user_22),
    INDEX(user_23),
    INDEX(user_24),
    INDEX(user_25),
    INDEX(user_26),
    INDEX(user_27),
    INDEX(user_28),
    INDEX(user_29),
    INDEX(user_30)
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
ADD FOREIGN KEY(vis) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE,
ADD FOREIGN KEY(roleid) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE u_guest
ADD FOREIGN KEY(isActive) REFERENCES m_coder(code) ON UPDATE CASCADE ON DELETE CASCADE;