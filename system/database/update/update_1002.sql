DROP TABLE IF EXISTS `reward_pay`;
CREATE TABLE `reward_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `trade_no` varchar(150) NOT NULL COMMENT '订单号',
  `type` varchar(150) NOT NULL COMMENT '支付类型',
  `addtime` datetime NOT NULL COMMENT '创建时间',
  `endtime` datetime NOT NULL COMMENT '结束时间',
  `name` varchar(150) NOT NULL COMMENT '订单昵称',
  `money` varchar(64) NOT NULL COMMENT '订单金额',
  `ip` varchar(20) NOT NULL COMMENT '创建IP',
  `city` varchar(150) NOT NULL COMMENT '创建城市',
  `domain` varchar(64) DEFAULT NULL COMMENT '来源域名',
  `user` varchar(32) NOT NULL COMMENT '隶属用户',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状况',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;