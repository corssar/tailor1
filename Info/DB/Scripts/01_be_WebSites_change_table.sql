ALTER TABLE `be_WebSites`
ADD COLUMN `useSMTPAuth`  int(2) NULL AFTER `SMTPPassword`,
ADD COLUMN `SMTPPort`  varchar(255) NULL AFTER `useSMTPAuth`;