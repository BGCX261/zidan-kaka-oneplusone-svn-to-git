// �����������ļ�
var outlookbar=new outlook();
var t;
t=outlookbar.addtitle('��Ϣ����','�Ź�����',1)
outlookbar.additem('����Ź�',t,'index.php?con=admin&act=groupmodify')
outlookbar.additem('�Ź�����',t,'index.php?con=admin&act=group')
outlookbar.additem('�����Ʒ',t,'index.php?con=admin&act=productsmodify')
outlookbar.additem('��Ʒ����',t,'index.php?con=admin&act=products')
outlookbar.additem('���й���',t,'index.php?con=admin&act=city')
outlookbar.additem('��Ʒ������',t,'index.php?con=admin&act=cate')
outlookbar.additem('��վ����',t,'index.php?con=admin&act=site')
outlookbar.additem('��վ�������',t,'index.php?con=admin&act=sitecate')
outlookbar.additem('�Ź�����',t,'index.php?con=admin&act=setting&type=group')

t=outlookbar.addtitle('�ɼ�����','�Ź�����',1)
outlookbar.additem('�ɼ���Ϣ',t,'index.php?con=admin&act=attach')
outlookbar.additem('�ɼ�����',t,'index.php?con=admin&act=setting&type=attach')


t=outlookbar.addtitle('��������','ϵͳ����',1)
outlookbar.additem('վ����Ϣ',t,'index.php?con=admin&act=setting&type=site')
outlookbar.additem('��������',t,'index.php?con=admin&act=setting&type=email')
outlookbar.additem('SEO����',t,'index.php?con=admin&act=setting&type=seo')
outlookbar.additem('ģ������',t,'index.php?con=admin&act=setting&type=template')



t=outlookbar.addtitle('��������','ϵͳ����',1)
outlookbar.additem('��������',t,'index.php?con=admin&act=file')

t=outlookbar.addtitle('���ݹ���','ϵͳ����',1)
outlookbar.additem('���ݿⱸ��',t,'index.php?con=database&act=backup')
outlookbar.additem('���ݿ�ָ�',t,'index.php?con=database&act=restore')

t=outlookbar.addtitle('���ӹ���','ϵͳ����',1)
outlookbar.additem('�������ӹ���',t,'index.php?con=admin&act=link')

t=outlookbar.addtitle('��Ա����','��Ա����',1)
outlookbar.additem('��Ա����',t,'index.php?con=admin&act=normaluser')
outlookbar.additem('��վ��',t,'index.php?con=admin&act=siteuser')
outlookbar.additem('����Ա',t,'index.php?con=admin&act=adminuser')
outlookbar.additem('������վ�ύ',t,'index.php?con=admin&act=nulluser')

t=outlookbar.addtitle('������','������',1)
outlookbar.additem('������',t,'index.php?con=admin&act=ad')
outlookbar.additem('������Ʒ',t,'index.php?con=admin&act=disgoods')

t=outlookbar.addtitle('���ò���','������ҳ',1)
outlookbar.additem('����Ź�',t,'index.php?con=admin&act=groupmodify')
outlookbar.additem('��Ϣ����',t,'index.php?con=admin&act=group')
outlookbar.additem('���Թ���',t,'index.php?con=admin&act=guestbook')
outlookbar.additem('��վ����',t,'index.php?con=admin&act=site')
outlookbar.additem('�ɼ���Ϣ',t,'index.php?con=admin&act=attach')
