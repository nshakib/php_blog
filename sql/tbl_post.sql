create table tbl_post(
    id int NOT null AUTO_INCREMENT,
    cat int,
    title varchar(255),
    body text,
    image varchar(255),
    author varchar(50),
    tags varchar(255),
    DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
    
);
