drop database ref_db;

create database ref_db;

use ref_db;

create table if not exists gene(
	g_id integer,
	gene_weblink varchar(255)
);

create table if not exists paper_gene(
	p_id integer,
	g_id integer
);

create table if not exists paper(
	p_id integer,
	j_id integer,
	year integer,
	paper_weblink varchar(255),
	paper_title varchar(255)
);

create table if not exists journal(
	j_id varchar(255),
	j_name varchar(255),
	j_publisher varchar(255)
);

create table if not exists paper_institution(
	p_id integer,
	i_id integer
);

create table if not exists institution(
	i_id integer,
	i_name varchar(255)	
);

create table if not exists paper_author(
	p_id integer,
	a_id integer
);

create table if not exists author(
	a_id integer,
	a_name varchar(255)
);

create table if not exists keyword(
	k_id integer,
	k_word varchar(255) 
);

create table if not exists paper_keyword(
	p_id integer,
	k_id integer
);

LOAD DATA LOCAL INFILE 'paper_data.csv' 
INTO TABLE paper
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA LOCAL INFILE 'journal_data.csv' 
INTO TABLE journal
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA LOCAL INFILE 'paper_institution_data.csv' 
INTO TABLE paper_institution
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA LOCAL INFILE 'institution_data.csv' 
INTO TABLE institution
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA LOCAL INFILE 'paper_author_data.csv' 
INTO TABLE paper_author
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA LOCAL INFILE 'author_data.csv' 
INTO TABLE author
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA LOCAL INFILE 'keyword_data.csv' 
INTO TABLE keyword
FIELDS TERMINATED BY ',' 
ESCAPED BY '"'
LINES TERMINATED BY '\n';







