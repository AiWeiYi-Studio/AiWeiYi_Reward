DROP TABLE IF EXISTS `reward_user_chat`;
CREATE TABLE `reward_user_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `colour` varchar(150) NOT NULL COMMENT '字体颜色',
  `message` varchar(250) NOT NULL COMMENT '信息内容',
  `addtime` datetime NOT NULL COMMENT '创建时间',
  `ip` varchar(20) NOT NULL COMMENT '创建IP',
  `city` varchar(150) NOT NULL COMMENT '创建城市',
  `user` varchar(32) NOT NULL COMMENT '隶属用户',
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '信息状况',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `reward_user`
ADD COLUMN `active_chat` int(1) NOT NULL DEFAULT '1' COMMENT '聊天发言权';

ALTER TABLE `reward_user`
ADD COLUMN `active_mail` int(1) NOT NULL DEFAULT '0' COMMENT '邮箱通知开关';

ALTER TABLE `reward_user`
ADD COLUMN `active_phone` int(1) NOT NULL DEFAULT '0' COMMENT '短信通知开关';