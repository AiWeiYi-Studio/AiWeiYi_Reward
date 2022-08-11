DROP TABLE IF EXISTS `reward_config`;
create table `reward_config` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reward_config` VALUES ('site_title', '爱唯逸网络科技');
INSERT INTO `reward_config` VALUES ('site_titles', '帮帮悬赏平台');
INSERT INTO `reward_config` VALUES ('site_keywords', '爱唯逸网络科技');
INSERT INTO `reward_config` VALUES ('site_description', '爱唯逸网络科技');
INSERT INTO `reward_config` VALUES ('site_jump', '0');
INSERT INTO `reward_config` VALUES ('site_active', '0');
INSERT INTO `reward_config` VALUES ('site_copyright', '爱唯逸网络科技');
INSERT INTO `reward_config` VALUES ('system_version', '1000');

DROP TABLE IF EXISTS `reward_user`;
CREATE TABLE `reward_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '随机ID',
  `user` varchar(11) NOT NULL COMMENT '用户账号',
  `pass` varchar(32) NOT NULL COMMENT '用户密码',
  `name` varchar(150) NOT NULL COMMENT '用户昵称',
  `token` varchar(150) NOT NULL COMMENT '用户密钥',
  `qq` varchar(20) DEFAULT NULL COMMENT '联系QQ',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系手机',
  `mail` varchar(150) NOT NULL COMMENT '联系邮箱',
  `reg_ip` varchar(150) DEFAULT NULL COMMENT '注册IP',
  `reg_city` varchar(150) DEFAULT NULL COMMENT '注册地址',
  `reg_time` datetime DEFAULT NULL COMMENT '添加时间',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(150) DEFAULT NULL COMMENT '上次登录IP',
  `client_ip` varchar(150) DEFAULT NULL COMMENT '绑定登录IP',
  `qq_token` text NOT NULL COMMENT 'QQ快捷登录',
  `weixin_token` text NOT NULL COMMENT '微信快捷登录',
  `weibo_token` text NOT NULL COMMENT '微博快捷登录',
  `alipay_token` text NOT NULL COMMENT '支付宝快捷登录',
  `money` varchar(255) NOT NULL COMMENT '钱包',
  `integral` varchar(250) NOT NULL COMMENT '积分',
  `mail_time` varchar(250) NOT NULL COMMENT '邮件余额',
  `iphone_time` varchar(250) NOT NULL COMMENT '短信余额',
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '账户状态',
  `active_ip` int(1) NOT NULL DEFAULT '0' COMMENT 'IP白名单登录开关',
  `avatar` varchar(250) NOT NULL COMMENT '头像',
  `number` varchar(250) NOT NULL COMMENT '接单数量',
  `numbers` varchar(250) NOT NULL COMMENT '结单数量',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reward_users`;
CREATE TABLE `reward_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '随机ID',
  `user` varchar(11) NOT NULL COMMENT '用户账号',
  `pass` varchar(32) NOT NULL COMMENT '用户密码',
  `token` text NOT NULL COMMENT '用户密钥',
  `qq` varchar(20) DEFAULT NULL COMMENT '联系QQ',
  `name` varchar(150) NOT NULL COMMENT '用户昵称',
  `mail` varchar(150) NOT NULL COMMENT '联系邮箱',
  `phone` varchar(150) NOT NULL COMMENT '联系手机',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `reg_time` datetime DEFAULT NULL COMMENT '添加时间',
  `login_ip` varchar(155) DEFAULT NULL COMMENT '上次登录IP',
  `client_ip` varchar(155) DEFAULT NULL COMMENT '绑定登录IP',
  `qq_token` text NOT NULL COMMENT 'QQ快捷登录',
  `weixin_token` text NOT NULL COMMENT '微信快捷登录',
  `weibo_token` text NOT NULL COMMENT '微博快捷登录',
  `alipay_token` text NOT NULL COMMENT '支付宝快捷登录',
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '账户状态',
  `active_ip` int(1) NOT NULL DEFAULT '0' COMMENT 'IP白名单登录开关',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reward_orders`;
CREATE TABLE `reward_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '随机ID',
  `type` varchar(150) NOT NULL COMMENT '订单类型',
  `place1` varchar(150) NOT NULL COMMENT '取货地址',
  `place2` varchar(150) NOT NULL COMMENT '收获地址',
  `phone1` varchar(150) NOT NULL COMMENT '联系方式1',
  `phone2` varchar(150) NOT NULL COMMENT '联系方式2',
  `text` varchar(150) NOT NULL COMMENT '订单简介',
  `money1` varchar(150) NOT NULL COMMENT '预计花费',
  `money2` varchar(150) NOT NULL COMMENT '跑腿红包',
  `add` datetime DEFAULT NULL COMMENT '添加时间',
  `end` datetime DEFAULT NULL COMMENT '结束时间',
  `user` varchar(150) NOT NULL COMMENT '隶属用户',
  `users` varchar(150) NOT NULL COMMENT '接单用户',
  `active` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `actives` int(1) NOT NULL DEFAULT '0' COMMENT '投诉状态',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reward_log`;
CREATE TABLE `reward_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `uid` varchar(150) DEFAULT NULL COMMENT '用户UID',
  `ip` varchar(20) DEFAULT NULL COMMENT '操作IP',
  `city` varchar(150) DEFAULT NULL COMMENT '操作城市',
  `type` varchar(150) NOT NULL COMMENT '操作类型',
  `content` varchar(150) NOT NULL COMMENT '操作内容',
  `date` datetime NOT NULL COMMENT '操作时间',
  `user` varchar(150) NOT NULL COMMENT '操作用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;