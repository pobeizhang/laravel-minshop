-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: book
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_item`
--

LOCK TABLES `cart_item` WRITE;
/*!40000 ALTER TABLE `cart_item` DISABLE KEYS */;
INSERT INTO `cart_item` VALUES (3,1,2,2,'2016-06-15 23:02:18','2016-06-15 23:02:20');
/*!40000 ALTER TABLE `cart_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `preview` varchar(100) NOT NULL DEFAULT 'null',
  `category_no` int(11) NOT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'php','',1,0,NULL,'2016-06-20 03:55:51'),(2,'java','',2,0,NULL,NULL),(3,'javascript','',3,0,NULL,NULL),(4,'laravel','',1,1,NULL,NULL),(5,'thinkphp','',2,1,NULL,'2016-06-19 17:36:15'),(6,'yii','',3,1,NULL,NULL),(7,'nodejs','',1,3,NULL,NULL),(8,'reactjs','',2,3,NULL,NULL),(9,'angularjs','',3,3,NULL,NULL),(10,'java base','',1,2,NULL,NULL),(11,'java web','',2,2,NULL,NULL),(15,'test','/upload/images/20160620/96d9d7256ef6570622cd237b86eae6d3.jpg',0,0,'2016-06-20 03:35:00','2016-06-20 03:35:00');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(16) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,NULL,'18518150393','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-10 20:26:11','',0),(2,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 16:24:45','duleijob@gmail.com',0),(3,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 16:26:54','duleijob@gmail.com',0),(4,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 16:33:46',' duleijob@gmail.com',0),(5,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 16:35:54','13264038896@163.com',0),(6,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 18:09:30','13264038896@163.com',0),(7,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 18:10:42','13264038896@163.com',0),(8,NULL,'','16f7b39bee8d2f93823c22ccc1e77c37','2016-06-12 13:42:20','2016-06-11 18:14:26','13264038896@163.com',1),(9,NULL,'','553a2ad00a5d7074416b1579decb6136','2016-06-25 03:10:57','2016-06-25 03:10:57','dulei1618@163.com',0),(10,NULL,'','553a2ad00a5d7074416b1579decb6136','2016-06-25 03:11:36','2016-06-25 03:11:36','1620202112@qq.com',0);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `order_no` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payway` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,1,'Edvd43eg4wgge',NULL,122.00,1,1,NULL,NULL);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `pdt_snapshot` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (1,1,1,3,NULL),(2,1,2,4,NULL);
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pdt_content`
--

DROP TABLE IF EXISTS `pdt_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdt_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(20000) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pdt_content`
--

LOCK TABLES `pdt_content` WRITE;
/*!40000 ALTER TABLE `pdt_content` DISABLE KEYS */;
INSERT INTO `pdt_content` VALUES (1,'第1章　Node简介\r\n1.1 　Node的诞生历程\r\n1.2 　Node的命名与起源\r\n1.2.1 　为什么是JavaScript\r\n1.2.2 　为什么叫Node\r\n1.3 　Node给JavaScript带来的意义\r\n1.4 　Node的特点\r\n1.4.1 　异步I/O\r\n1.4.2 　事件与回调函数\r\n1.4.3 　单线程\r\n1.4.4 　跨平台\r\n1.5 　Node的应用场景\r\n1.5.1 　I/O密集型\r\n1.5.2 　是否不擅长CPU密集型业务\r\n1.5.3 　与遗留系统和平共处\r\n1.5.4 　分布式应用\r\n1.6 　Node的使用者\r\n1.7 　参考资源\r\n\r\n第2章　模块机制\r\n2.1 　CommonJS规范\r\n2.1.1 　CommonJS的出发点\r\n2.1.2 　CommonJS的模块规范\r\n2.2 　Node的模块实现\r\n2.2.1 　优先从缓存加载\r\n2.2.2 　路径分析和文件定位\r\n2.2.3 　模块编译\r\n2.3 　核心模块\r\n2.3.1 　JavaScript核心模块的编译过程\r\n2.3.2 　C/C++核心模块的编译过程\r\n2.3.3 　核心模块的引入流程\r\n2.3.4 　编写核心模块\r\n2.4 　C/C++扩展模块\r\n2.4.1 　前提条件\r\n2.4.2 　C/C++扩展模块的编写\r\n2.4.3 　C/C++扩展模块的编译\r\n2.4.4 　C/C++扩展模块的加载\r\n2.5 　模块调用栈\r\n2.6 　包与NPM\r\n2.6.1 　包结构\r\n2.6.2 　包描述文件与NPM\r\n2.6.3 　NPM常用功能\r\n2.6.4 　局域NPM\r\n2.6.5 　NPM潜在问题\r\n2.7 　前后端共用模块\r\n2.7.1 　模块的侧重点\r\n2.7.2 　AMD规范\r\n2.7.3 　CMD规范\r\n2.7.4 　兼容多种模块规范\r\n2.8 　总结\r\n2.9 　参考资源\r\n\r\n第3章　异步I/O\r\n3.1 　为什么要异步I/O\r\n3.1.1 　用户体验\r\n3.1.2 　资源分配\r\n3.2 　异步I/O实现现状\r\n3.2.1 　异步I/O与非阻塞I/O\r\n3.2.2 　理想的非阻塞异步I/O\r\n3.2.3 　现实的异步I/O\r\n3.3 　Node的异步I/O\r\n3.3.1 　事件循环\r\n3.3.2 　观察者\r\n3.3.3 　请求对象\r\n3.3.4 　执行回调\r\n3.3.5 　小结\r\n3.4 　非I/O的异步API\r\n3.4.1 　定时器\r\n3.4.2 　process.nextTick()\r\n3.4.3 　setImmediate()\r\n3.5 　事件驱动与高性能服务器\r\n3.6 　总结\r\n3.7 　参考资源\r\n\r\n第4章　异步编程\r\n4.1 　函数式编程\r\n4.1.1 　高阶函数\r\n4.1.2 　偏函数用法\r\n4.2 　异步编程的优势与难点\r\n4.2.1 　优势\r\n4.2.2 　难点\r\n4.3 　异步编程解决方案\r\n4.3.1 　事件发布/订阅模式\r\n4.3.2 　Promise/Deferred模式\r\n4.3.3 　流程控制库\r\n4.4 　异步并发控制\r\n4.4.1 　bagpipe的解决方案\r\n4.4.2 　async的解决方案\r\n4.5 　总结\r\n4.6 　参考资源\r\n\r\n第5章　内存控制\r\n5.1 　V8的垃圾回收机制与内存限制\r\n5.1.1 　Node与V8\r\n5.1.2 　V8的内存限制\r\n5.1.3 　V8的对象分配\r\n5.1.4 　V8的垃圾回收机制\r\n5.1.5 　查看垃圾回收日志\r\n5.2 　高效使用内存\r\n5.2.1 　作用域\r\n5.2.2 　闭包\r\n5.2.3 　小结\r\n5.3 　内存指标\r\n5.3.1 　查看内存使用情况\r\n5.3.2 　堆外内存\r\n5.3.3 　小结\r\n5.4 　内存泄漏\r\n5.4.1 　慎将内存当做缓存\r\n5.4.2 　关注队列状态\r\n5.5 　内存泄漏排查\r\n5.5.1 　node-heapdump\r\n5.5.2 　node-memwatch\r\n5.5.3 　小结\r\n5.6 　大内存应用\r\n5.7 　总结\r\n5.8 　参考资源\r\n\r\n第6章 　理解Buffer\r\n6.1 　Buffer结构\r\n6.1.1 　模块结构\r\n6.1.2 　Buffer对象\r\n6.1.3 　Buffer内存分配\r\n6.2 　Buffer的转换\r\n6.2.1 　字符串转Buffer\r\n6.2.2 　Buffer转字符串\r\n6.2.3 　Buffer不支持的编码类型\r\n6.3 　Buffer的拼接\r\n6.3.1 　乱码是如何产生的\r\n6.3.2 　setEncoding()与string_decoder()\r\n6.3.3 　正确拼接Buffer\r\n6.4 　Buffer与性能\r\n6.5 　总结\r\n6.6 　参考资源\r\n\r\n第7章　网络编程\r\n7.1 　构建TCP服务\r\n7.1.1 　TCP\r\n7.1.2 　创建TCP服务器端\r\n7.1.3 　TCP服务的事件\r\n7.2 　构建UDP服务\r\n7.2.1 　创建UDP套接字\r\n7.2.2 　创建UDP服务器端\r\n7.2.3 　创建UDP客户端\r\n7.2.4 　UDP套接字事件\r\n7.3 　构建HTTP服务\r\n7.3.1 　HTTP\r\n7.3.2 　http模块\r\n7.3.3 　HTTP客户端\r\n7.4 　构建WebSocket服务\r\n7.4.1 　WebSocket握手\r\n7.4.2 　WebSocket数据传输\r\n7.4.3 　小结\r\n7.5 　网络服务与安全\r\n7.5.1 　TLS/SSL\r\n7.5.2 　TLS服务\r\n7.5.3 　HTTPS服务\r\n7.6 　总结\r\n7.7 　参考资源\r\n\r\n第8章　构建Web应用\r\n8.1 　基础功能\r\n8.1.1 　请求方法\r\n8.1.2 　路径解析\r\n8.1.3 　查询字符串\r\n8.1.4 　Cookie\r\n8.1.5 　Session\r\n8.1.6 　缓存\r\n8.1.7 　Basic认证\r\n8.2 　数据上传\r\n8.2.1 　表单数据\r\n8.2.2 　其他格式\r\n8.2.3 　附件上传\r\n8.2.4 　数据上传与安全\r\n8.3 　路由解析\r\n8.3.1 　文件路径型\r\n8.3.2 　MVC\r\n8.3.3 　RESTful\r\n8.4 　中间件\r\n8.4.1 　异常处理\r\n8.4.2 　中间件与性能\r\n8.4.3 　小结\r\n8.5 　页面渲染\r\n8.5.1 　内容响应\r\n8.5.2 　视图渲染\r\n8.5.3 　模板\r\n8.5.4 　Bigpipe\r\n8.6 　总结\r\n8.7 　参考资源\r\n\r\n第9章　玩转进程\r\n9.1 　服务模型的变迁\r\n9.1.1 　石器时代：同步\r\n9.1.2 　青铜时代：复制进程\r\n9.1.3 　白银时代：多线程\r\n9.1.4 　黄金时代：事件驱动\r\n9.2 　多进程架构\r\n9.2.1 　创建子进程\r\n9.2.2 　进程间通信\r\n9.2.3 　句柄传递\r\n9.2.4 　小结\r\n9.3 　集群稳定之路\r\n9.3.1 　进程事件\r\n9.3.2 　自动重启\r\n9.3.3 　负载均衡\r\n9.3.4 　状态共享\r\n9.4 　Cluster模块\r\n9.4.1 　Cluster工作原理\r\n9.4.2 　Cluster事件\r\n9.5 　总结\r\n9.6 　参考资源\r\n\r\n第10章　测试\r\n10.1 　单元测试\r\n10.1.1 　单元测试的意义\r\n10.1.2 　单元测试介绍\r\n10.1.3 　工程化与自动化\r\n10.1.4 　小结\r\n10.2 　性能测试\r\n10.2.1 　基准测试\r\n10.2.2 　压力测试\r\n10.2.3 　基准测试驱动开发\r\n10.2.4 　测试数据与业务数据的转换\r\n10.3 　总结\r\n10.4 　参考资源\r\n\r\n第11章　产品化\r\n11.1 　项目工程化\r\n11.1.1 　目录结构\r\n11.1.2 　构建工具\r\n11.1.3 　编码规范\r\n11.1.4 　代码审查\r\n11.2 　部署流程\r\n11.2.1 　部署环境\r\n11.2.2 　部署操作\r\n11.3 　性能\r\n11.3.1 　动静分离\r\n11.3.2 　启用缓存\r\n11.3.3 　多进程架构\r\n11.3.4 　读写分离\r\n11.4 　日志\r\n11.4.1 　访问日志\r\n11.4.2 　异常日志\r\n11.4.3 　日志与数据库\r\n11.4.4 　分割日志\r\n11.4.5 　小结\r\n11.5 　监控报警\r\n11.5.1 　监控\r\n11.5.2 　报警的实现\r\n11.5.3 　监控系统的稳定性\r\n11.6 　稳定性\r\n11.7 　异构共存\r\n11.8 　总结\r\n11.9 　参考资源\r\n\r\n附录A 　安装Node\r\nA.1 　Windows系统下的Node安装\r\nA.2 　Mac系统下Node的安装\r\nA.3 　Linux系统下Node的安装\r\nA.4 　总结\r\nA.5 　参考资源\r\n附录B 　调试Node\r\nB.1 　Debugger\r\nB.2 　Node Inspector\r\nB.2.1 　安装Node Inspector\r\nB.2.2 　错误堆栈\r\nB.3 　总结\r\n附录C 　Node编码规范\r\nC.1 　根源\r\nC.2 　编码规范\r\nC.2.1 　空格与格式\r\nC.2.2 　命名规范\r\nC.2.3 　比较操作\r\nC.2.4 　字面量\r\nC.2.5 　作用域\r\nC.2.6 　数组与对象\r\nC.2.7 　异步\r\nC.2.8 　类与模块\r\nC.2.9 　注解规范\r\nC.3 　最佳实践\r\nC.3.1 　冲突的解决原则\r\nC.3.2 　给编辑器设置检测工具\r\nC.3.3 　版本控制中的hook\r\nC.3.4 　持续集成\r\nC.4 　总结\r\nC.5 　参考资源\r\n附录D 　搭建局域NPM仓库\r\nD.1 　NPM仓库的安装\r\nD.1.1 　安装Erlang和CouchDB\r\nD.1.2 　搭建NPM仓库\r\nD.2 　高阶应用\r\nD.2.1 　镜像仓库\r\nD.2.2 　私有模块应用\r\nD.2.3 　纯私有仓库\r\nD.3 　总结\r\nD.4 　参考资源\r\n查看全部↓\r\n精彩书摘\r\n　　1　Node简介 \r\n　　Node应该是如今最火热的技术了，从本章开始，我们将逐步揭示它的诸多细节。 \r\n　　1．1 Node的诞生历程 \r\n　　NodelJ，3诞生历程如下所示。 \r\n　　2009年3月，RyanDahl在其博客上宣布准备基于V8创建一个轻量级的Web务器并提供一套库。 \r\n　　2009年5月，RyanDalai在GitHub上发布了最初的版本。 \r\n　　2009年12月和2010年4月，两届JSConfJ（会都安排了Node的讲座。 \r\n　　2010年年底，Node获得硅谷云计算服务商Joyent公司的资助，其创始人Joyent公司全职负责Node的发展。 \r\n　　2011年7月，Node在微软的支持下发布了其Windows版本。 \r\n　　2011年1lYl，Node超越RubyonRails，成为GitHub上关注度最高的项目（随后被Bootstrap项目超越，目前仍居第二）。 \r\n　　2012年1月底，RyanDahl在~Node架构设计满意的情况下，将掌门人的身份转交给IsaacZ．Schlueter，自己转向一些研究项目。IsaacZSchlueter是Node的包管理器NPM的作者，之后Node的版本发布和bug修复等工作由他接手。截至笔者执笔之曰（2013年7月13日），发布的Node稳定版为v0．10．13，非稳定版为v0．11．4，NPM的官方模块数达到34943个，模块的周下载量为1479万次。 \r\n　　随后，Node的发布计划主要集中在性能提升上，在v0．14之后，正式发布vI．O版本。 \r\n　　1．2 Node的命名与起源 \r\n　　在Node的官方网站之外，N0dc具有很多别称：Nodejs、NodeJS、Node．is等。本书在写作过程中遵循官方的说法，将会一直使用Node这个名字，但是在当前语境之外，为了与其余表示节点的技术或名词相区别，均可以带上is表明它是Node。在听到这些词汇时，应该意识到，它们说的是一码事。除了本书的封面和此处会用到N0dejs外，其余地方都会以Node作为正式称谓。 \r\n　　Node名字的来由，其实跟它的起源是有密切关系的。 \r\n　　1．2．1 为什么是JavaScript \r\n　　RvanDahl是一名资深的C／C++程序员，在创造出N0de之前，他的主要工作都是围绕高性能we服务器进行的。经历过一些尝试和失败之后，他找到了设计高性能，WebH~务器的几个要点：事件驱动、非阻塞I／O。 \r\n　　所以RvanDahl最初的目标是写一个基于事件驱动、非阻塞I／O的Web服务器，以达到更高的性能，提供Apache等服务器之外的选择。他提到，大多数人不设计一种更简单和更有效率的程序的主要原因是他们用到了阻塞I／O的库。写作Node的时候，RyanDahl~评估过C、Lua、Haskell、Ruby等语言作为备选实现，结论为：C的开发门槛高，可以预见不会有太多的开发者能将它用于日常的业务开发，所以舍弃它；RyanDahl觉得自己还不足够玩转Haskell，所以舍弃它；Lua自身已经含有很多阻塞I／0库，为其构建非阻塞I／O库也不能改变人们继续使用阻塞I／0库的习惯，所以也舍弃它；而Ruby的虚拟机由于性能不好而落选。 \r\n　　相比之下，JavaSCriptt：gC的开发门槛要低，比Lua的历史包袱要少。尽管服务器端JavaScript存在已经很多年了，但是后端部分一直没有市场，可以说历史包袱为零，为其导人非阻塞I／0库没有额外阻力。另外，JavaScript4览器中有广泛的事件驱动方面的应用，暗合RyanDahl喜好基于事件驱动的需求。当时，第二次浏览器大战也渐渐分出高下，Chrome浏览器的JavaSCript引擎V8摘得性能第一的桂冠，而EL其基于新BSD许可证发布，自然受到RyanDahl的欢迎。考虑到高性能、符合事件驱动、没有历史包袱这3个主要原因．JavaScript成N（Node~J实现语言。 \r\n　　1．2．2 为什么叫Node \r\n　　起初，RyanDahl称他的项目为web．js，就是一个We服务器，但是项目的发展超过了他最初单纯开发一个Web服务器的想法，变成了构建网络应用的一个基础框架，这样可以在它的基础上构建更多的东西，诸如服务器、客户端、命令行工具等。Node为一个强制不共享任何资源的单线程、单进程系统，包含十分适宜网络的库，为构建大型分布式应用程序提供基础设施，其目标也是成为一个构建快速、可伸缩的网络应用平台。它自身非常简单，通过通信协议来组织许多N0de，非常容易通过扩展来达成构建大型网络应用的目的。每一个Node进程都构成这个网络应用中的一个节点，这是它名字所含意义的真谛 \r\n　　……\r\n查看全部↓\r\n前言/序言\r\n　　2006年至今，我们时常可以看到JavaScript的新闻，刚开始只是JavaScript引擎性能的提升，到后来发现很多是来自HTML5和Node创造的奇迹。如果只看表面，很容易让人感觉这又是一颗卫星。这种现象让人觉得不可信，所以出现了以下各种版本的误解。\r\n　　Node肯定是几个前端工程师在实验室里捣鼓出来的。\r\n　　为了后端而后端，有意思吗？\r\n　　怎么又发明了一门新语言？\r\n　　JavaScript承担的责任太重了。\r\n　　直觉上，JavaScript不应该运行在后端。\r\n　　前端工程师要逆袭了。\r\n　　一方面，大家看到JavaScript在各个地方放出异彩，其他语言的开发者既羡慕它的成果，又担心它对当前所从事的语言造成冲击；另一方面，人们还是有JavaScript只能做前端脚本的定势思维。究其原因，还是因为人们缺乏历史观层次上的认知，所以会产生一些莫须有的惴惴不安。\r\n　　1995年，JavaScript随网景公司发布的Netscape Navigator 2.0发布，它最早命名为LiveScript，随后更名为JavaScript。',1,NULL,NULL),(2,'<p>tstststetset</p>',5,'2016-06-20 04:31:04','2016-06-20 04:31:04');
/*!40000 ALTER TABLE `pdt_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pdt_images`
--

DROP TABLE IF EXISTS `pdt_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdt_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(200) NOT NULL,
  `image_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pdt_images`
--

LOCK TABLES `pdt_images` WRITE;
/*!40000 ALTER TABLE `pdt_images` DISABLE KEYS */;
INSERT INTO `pdt_images` VALUES (1,'/images/1.jpg',1,1,NULL,NULL),(2,'/images/2.jpg',2,1,NULL,NULL),(3,'/images/3.jpg',3,1,NULL,NULL),(4,'/upload/images/20160620/301b6a88d181893397a3053efa263305.jpg',1,5,'2016-06-20 04:31:04','2016-06-20 04:31:04'),(5,'/upload/images/20160620/ccdb331cbe87f604451acce78c27abe1.jpg',2,5,'2016-06-20 04:31:04','2016-06-20 04:31:04');
/*!40000 ALTER TABLE `pdt_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `preview` varchar(200) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'深入浅出Node.js','/images/1.jpg','第一本深度讲解Node的图书，源码级别探寻Node的实现原理，阿里巴巴一线Node开发者最真实的经验',30.00,7,NULL,NULL),(2,'Node.js权威指南','/images/2.jpg','以实践为导向，不仅为每个知识点配备了精巧的小案例。而且还设计了2个可操作性极强的综合性案例',26.00,7,NULL,NULL),(3,'React','/images/3.jpg','身出名门。Facebook开源巨献，一经推出，瞬间亮瞎全球功能工程师，以BAT为首的一线国内互联网企业均以快速跟进研发、实践React，下一次求职你就一定会被面到',25.00,8,NULL,NULL),(4,'React Native','/images/4.jpg','如果你对开发Web端的原生移动应用感兴趣，《React Native：用JavaScript开发移动应用》就是一本不容错过的以实例代码为引导的入门书籍',40.00,8,NULL,NULL),(5,'test','/upload/images/20160620/db45c494b7f6ca9478f6d2b86ed2dd2d.jpg','test',999.00,4,'2016-06-20 04:31:03','2016-06-20 04:31:03');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_email`
--

DROP TABLE IF EXISTS `temp_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_email` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_email`
--

LOCK TABLES `temp_email` WRITE;
/*!40000 ALTER TABLE `temp_email` DISABLE KEYS */;
INSERT INTO `temp_email` VALUES (1,7,'f5bd7bb82b015e716f1a49c5bc6a09ce','2016-06-12 18:10:42'),(2,8,'829535b930ac13e8b6f692f3f39c201d','2016-06-12 18:13:10'),(3,9,'1de9774f14984f5dd9b75f553b531785','2016-06-26 03:10:57'),(4,10,'546c32debeb4fa757ba363a0998a7b62','2016-06-26 03:11:36');
/*!40000 ALTER TABLE `temp_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tempphone`
--

DROP TABLE IF EXISTS `tempphone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tempphone` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` int(11) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tempphone`
--

LOCK TABLES `tempphone` WRITE;
/*!40000 ALTER TABLE `tempphone` DISABLE KEYS */;
/*!40000 ALTER TABLE `tempphone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-01 15:09:41
