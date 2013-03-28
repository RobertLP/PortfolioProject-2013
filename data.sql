drop database if exists `portofolio`;

create database `portofolio`
  default character set utf8
  default collate utf8_general_ci;

grant all privileges on `portofolio` . * to `portofolio`@`localhost` identified by 'sfhdKLG^%*^T86to86t68GR&^rt56dc7ui^R&I%F8';

use portofolio;

create table settings (
  setting varchar(32),
  value varchar(256),
  primary key (setting)
) engine=InnoDB;

create table pages (
  page_id int not null auto_increment,
  name varchar(32) not null,
  num_blocks int not null,
  icon varchar(128) not null,
  floats enum('left', 'right', 'both') not null,
  primary key (page_id)
) engine=InnoDB;

create table blocks (
  block_id int not null auto_increment,
  page_id int not null,
  title varchar(64) not null,
  content varchar(4096) not null,
  photo varchar(128) not null,
  primary key (block_id),
  index fk_blokken_pages (page_id)
) engine=InnoDB;

create table fonts (
  font_id int not null auto_increment,
  font_name varchar(32) not null,
  font_family varchar(32) not null,
  primary key (font_id)
) engine=InnoDB;

INSERT INTO `pages` (`page_id`, `name`, `num_blocks`, `icon`, `floats`) VALUES
(1, 'Test page 1', 5,	'icon1.png', 'left'),
(2, 'Test page 2', 10,	'icon2.png', 'right'),
(3, 'Test page 3', 10,	'icon2.png', 'both');

INSERT INTO `blocks` (`page_id`, `title`, `content`, `photo`) VALUES
(1, 'Test block 10', 'This is a block', 'http://farm9.staticflickr.com/8443/7853981544_4b033343d4_k.jpg'),
(1, 'Test block 11', 'This is a block', 'http://farm9.staticflickr.com/8080/8301934159_f3d1e4b84d_k.jpg'),
(1, 'Test block 12', 'This is a block', 'http://farm9.staticflickr.com/8518/8424571441_c732e1eb60_k.jpg'),
(1, 'Test block 13', 'This is a block', 'http://farm9.staticflickr.com/8443/7853981544_4b033343d4_k.jpg'),

(2, 'Test block 20', 'This is a block', 'http://farm9.staticflickr.com/8080/8301934159_f3d1e4b84d_k.jpg'),
(2, 'Test block 21', 'This is a block', 'http://farm9.staticflickr.com/8518/8424571441_c732e1eb60_k.jpg'),
(2, 'Test block 22', 'This is a block', 'http://farm9.staticflickr.com/8443/7853981544_4b033343d4_k.jpg'),
(2, 'Test block 23', 'This is a block', 'http://farm9.staticflickr.com/8080/8301934159_f3d1e4b84d_k.jpg'),

(3, 'Test block 30', 'This is a block', 'http://farm9.staticflickr.com/8518/8424571441_c732e1eb60_k.jpg'),
(3, 'Test block 31', 'This is a block', 'http://farm9.staticflickr.com/8443/7853981544_4b033343d4_k.jpg'),
(3, 'Test block 32', 'This is a block', 'http://farm9.staticflickr.com/8080/8301934159_f3d1e4b84d_k.jpg'),
(3, 'Test block 33', 'This is a block', 'http://farm9.staticflickr.com/8518/8424571441_c732e1eb60_k.jpg');

INSERT INTO `settings` (`setting`, `value`) VALUES
('page_head',			'This is a test'),
('title_font_size',		'16pt'),
('title_font_family',	'1'),
('text_font_size',		'11pt'),
('text_font_family',	'2');

INSERT INTO `fonts` (`font_name`, `font_family`) VALUES
('Arial',				'sans-serif'),
('Times New Roman',		'serif'),
('Verdana',				'sans-serif'),
('Helvetica',			'sans-serif'),
('Courier New',			'monospace'),
('DejaVu Sans',			'sans-serif'),
('DejaVu Serif',		'serif'),
('DejaVu Sans Mono',	'monospace');
