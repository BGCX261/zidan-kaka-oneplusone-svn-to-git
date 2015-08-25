// 导航栏配置文件
var outlookbar=new outlook();
var t;
t=outlookbar.addtitle('信息管理','团购管理',1)
outlookbar.additem('添加团购',t,'index.php?con=admin&act=groupmodify')
outlookbar.additem('团购管理',t,'index.php?con=admin&act=group')
outlookbar.additem('添加商品',t,'index.php?con=admin&act=productsmodify')
outlookbar.additem('商品管理',t,'index.php?con=admin&act=products')
outlookbar.additem('城市管理',t,'index.php?con=admin&act=city')
outlookbar.additem('商品类别管理',t,'index.php?con=admin&act=cate')
outlookbar.additem('网站管理',t,'index.php?con=admin&act=site')
outlookbar.additem('网站分类管理',t,'index.php?con=admin&act=sitecate')
outlookbar.additem('团购设置',t,'index.php?con=admin&act=setting&type=group')

t=outlookbar.addtitle('采集管理','团购管理',1)
outlookbar.additem('采集信息',t,'index.php?con=admin&act=attach')
outlookbar.additem('采集设置',t,'index.php?con=admin&act=setting&type=attach')


t=outlookbar.addtitle('基本设置','系统设置',1)
outlookbar.additem('站点信息',t,'index.php?con=admin&act=setting&type=site')
outlookbar.additem('邮箱设置',t,'index.php?con=admin&act=setting&type=email')
outlookbar.additem('SEO设置',t,'index.php?con=admin&act=setting&type=seo')
outlookbar.additem('模板设置',t,'index.php?con=admin&act=setting&type=template')



t=outlookbar.addtitle('附件管理','系统设置',1)
outlookbar.additem('附件管理',t,'index.php?con=admin&act=file')

t=outlookbar.addtitle('数据管理','系统设置',1)
outlookbar.additem('数据库备份',t,'index.php?con=database&act=backup')
outlookbar.additem('数据库恢复',t,'index.php?con=database&act=restore')

t=outlookbar.addtitle('链接管理','系统设置',1)
outlookbar.additem('友情链接管理',t,'index.php?con=admin&act=link')

t=outlookbar.addtitle('会员管理','会员管理',1)
outlookbar.additem('会员管理',t,'index.php?con=admin&act=normaluser')
outlookbar.additem('网站主',t,'index.php?con=admin&act=siteuser')
outlookbar.additem('管理员',t,'index.php?con=admin&act=adminuser')
outlookbar.additem('匿名网站提交',t,'index.php?con=admin&act=nulluser')

t=outlookbar.addtitle('广告管理','广告管理',1)
outlookbar.additem('广告管理',t,'index.php?con=admin&act=ad')
outlookbar.additem('打折商品',t,'index.php?con=admin&act=disgoods')

t=outlookbar.addtitle('常用操作','管理首页',1)
outlookbar.additem('添加团购',t,'index.php?con=admin&act=groupmodify')
outlookbar.additem('信息管理',t,'index.php?con=admin&act=group')
outlookbar.additem('留言管理',t,'index.php?con=admin&act=guestbook')
outlookbar.additem('网站管理',t,'index.php?con=admin&act=site')
outlookbar.additem('采集信息',t,'index.php?con=admin&act=attach')
