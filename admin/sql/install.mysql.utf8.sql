DROP TABLE IF EXISTS `#__xpoll`;
DROP TABLE IF EXISTS `#__xpoll_answers`;

CREATE TABLE `#__xpoll` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `asset_id` INT(10) NOT NULL DEFAULT '0',
    `title` varchar(255) NOT NULL,
    `catid` int(11) NOT NULL DEFAULT '0',
    `params` TEXT NOT NULL DEFAULT '',
    `answer` varchar(25) NOT NULL,
    PRIMARY KEY  (`id`)
   ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
 
CREATE TABLE `#__xpoll_answers`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(25) NOT NULL,
    `count` int(11) NOT NULL DEFAULT '0',
    `pid` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY  (`id`),
    FOREIGN KEY (`pid`)
    REFERENCES `#__xpoll` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__xpoll` (`id`, `title`, `params`) VALUES ('1', 'Понравился ли Вам компонент "Опросник!"?', '{"show_category":"0"}');
INSERT INTO `#__xpoll_answers` (`title`, `count`, `pid`) VALUES ('Да, очень!', '0', '1'), ('Нет! Он ужасен!','0','1'), ('Йа креведко! (^__^)','0','1');