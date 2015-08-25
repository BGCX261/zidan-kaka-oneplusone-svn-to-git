<?php


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
define('CURSCRIPT','database');
class database_controller
{
	function database_controller()
	{
		include (ROOT_PATH . 'inc/sqldump.class.php');
		$this->dump=new cls_sql_dump($GLOBALS['db']);
		@ini_set('memory_limit', '64M');
		$this->path = ROOT_PATH.'/data/sqlbackup';
	}
	function backup_action()
	{
		global $db;
		$query = $db->query("SHOW TABLES LIKE '" .$GLOBALS['table_prefix']. "%'");
		while($t=$db->fetch_array($query))
		{
			$table=array_values($t);
			$tables[]=$table[0];
		}
		$allow_max_size = $this->return_bytes(@ini_get('upload_max_filesize')); // ��λΪ�ֽ�
		$allow_max_size = $allow_max_size / 1024; // ת����λΪ KB
		$mask = $this->file_mode_info($this->path);
		if ($mask === false)
		{
			exit($this->path.'Ŀ¼������');
		}
		else
		{
			$sql_file_name = $this->dump->get_random_name();
			include ROOT_PATH.'/views/admin/database/backup.php';
		}
	}
	/* ���ݻָ�ҳ�� */
	function restore_action()
	{
		$list = array();

		/* ���Ŀ¼ */
		$mask = $this->file_mode_info($this->path);
		if ($mask === false)
		{
			exit($this->path.'Ŀ¼������');
		}
		elseif (($mask & 1) < 1)
		{
			exit($this->path.'Ŀ¼���ɶ�');
		}
		else
		{
			/* ��ȡ�ļ��б� */
			$real_list = array();
			$folder = opendir($this->path);
			while ($file = readdir($folder))
			{
				if (strpos($file,'.sql') !== false)
				{
					$real_list[] = $file;
				}
			}
			natsort($real_list);

			$match = array();
			foreach ($real_list AS $file)
			{
				if (preg_match('/_([0-9])+\.sql$/', $file, $match))
				{
					if ($match[1] == 1)
					{
						$mark = 1;
					}
					else
					{
						$mark = 2;
					}
				}
				else
				{
					$mark = 0;
				}

				$file_size = filesize($this->path.'/'.$file);
				$info = $this->dump->get_head($this->path.'/'.$file);
				$list[] = array('name' => $file, 'ver' => $info['phpup_ver'], 'add_time' => $info['date'], 'vol' => $info['vol'], 'file_size' => $this->num_bitunit($file_size), 'mark' => $mark);
			}
			include ROOT_PATH.'/views/admin/database/restore.php';
		}
	}
	function remove_action()
	{
		 if (isset($_POST['file']))
		{
			$m_file = array(); //����ļ�
			$s_file = array(); //�����ļ�

			$path = ROOT_PATH . DATA_DIR . '/sqldata/';

			foreach ($_POST['file'] AS $file)
			{
				if (preg_match('/_[0-9]+\.sql$/', $file))
				{
					$m_file[] = substr($file, 0, strrpos($file, '_'));
				}
				else
				{
					$s_file[] = $file;
				}
			}

			if ($m_file)
			{
				$m_file = array_unique ($m_file);

				/* ��ȡ�ļ��б� */
				$real_file = array();

				$folder = opendir($this->path);
				while ($file = readdir($folder))
				{
					if ( preg_match('/_[0-9]+\.sql$/', $file) && is_file($this->path.'/'.$file))
					{
						$real_file[] = $file;
					}
				}

				foreach ($real_file AS $file)
				{
					$short_file = substr($file, 0, strrpos($file, '_'));
					if (in_array($short_file, $m_file))
					{
						@unlink($this->path.'/'.$file);
					}
				}
			}

			if ($s_file)
			{
				foreach ($s_file AS $file)
				{
					@unlink($this->path.'/'.$file);
				}
			}
		}
		sheader('index.php?con=database&act=restore',3,'sql�ļ��������','redirect',true);
	}
	/* �ӷ������ϵ������� */
	function import_action()
	{
			$is_confirm = empty($_GET['confirm']) ? false : true;
			$file_name = empty($_GET['file_name']) ? '': trim($_GET['file_name']);
			$path = $this->path.'/';
			
			/* �����ִ��ʱ��Ϊ5���� */
			@set_time_limit(300);

			if (preg_match('/_[0-9]+\.sql$/', $file_name))
			{
				/* ����� */
				if ($is_confirm == false)
				{
					/* ��ʾ�û�Ҫ��ȷ�� */
					sheader('index.php?con=database&act=import&confirm=1&file_name=' . $file_name,30, 'ȷ�ϻָ���','redirect', true);
				}

				$short_name = substr($file_name, 0, strrpos($file_name, '_'));

				/* ��ȡ�ļ��б� */
				$real_file = array();
				$folder = opendir($path);
				while ($file = readdir($folder))
				{
					if (is_file($path . $file) && preg_match('/_[0-9]+\.sql$/', $file))
					{
						$real_file[] = $file;
					}
				}

				/* ������ͬ�־������б� */
				$post_list = array();
				foreach ($real_file AS $file)
				{
					$tmp_name = substr($file, 0, strrpos($file, '_'));
					if ($tmp_name == $short_name)
					{
						$post_list[] = $file;
					}
				}

				natsort($post_list);

				/* ��ʼ�ָ����� */
				foreach ($post_list AS $file)
				{
					$info = $this->dump->get_head($path . $file);
					if ($info['phpup_ver'] != VERSION )
					{
						sheader('index.php?con=database&act=restore',180, $info['phpup_ver'].'�汾����','redirect', true);
					}
					if (!$this->sql_import($path . $file))
					{
						sheader('index.php?con=database&act=restore',180,  $file.'�ļ�����','redirect', true);
					}
				}

				sheader('index.php?con=database&act=restore',3, '�ָ��ɹ�','redirect', true);
			}
			else
			{
				/* ���� */
				$info = $this->dump->get_head($path . $file_name);
				if ($info['phpup_ver'] != VERSION )
				{
					sheader('index.php?con=database&act=restore',180, $info['phpup_ver'].'�汾����','redirect', true);
				}
				if ($this->sql_import($path . $file_name))
				{
					sheader('index.php?con=database&act=restore',3, '�ָ��ɹ�','redirect', true);
				}
				else
				{
					 sheader('index.php?con=database&act=restore',180,  $file.'�ļ�����','redirect', true);
				}
			}
		
	}
	function dumpsql_action()
	{
		global $db;
		$dump=$this->dump;
		/* �����ִ��ʱ��Ϊ5���� */
		@set_time_limit(300);
		$run_log = $this->path.'/run.log';
		/* ��ʼ��������� */
		if (empty($_REQUEST['sql_file_name']))
		{
			$sql_file_name = $dump->get_random_name();
		}
		else
		{
			$sql_file_name = str_replace("0xa", '', trim($_REQUEST['sql_file_name'])); // ���� 0xa �Ƿ��ַ�
			$pos = strpos($sql_file_name, '.sql');
			if ($pos !== false)
			{
				$sql_file_name = substr($sql_file_name, 0, $pos);
			}
		}
        $max_size = empty($_REQUEST['vol_size']) ? 0 : intval($_REQUEST['vol_size']);
		$vol = empty($_REQUEST['vol']) ? 1 : intval($_REQUEST['vol']);
		$is_short = empty($_REQUEST['ext_insert']) ? false : true;

		$dump->is_short = $is_short;

		/* ������֤ */
		$allow_max_size = intval(@ini_get('upload_max_filesize')); //��λM
		if ($allow_max_size > 0 && $max_size > ($allow_max_size * 1024))
		{
			$max_size = $allow_max_size * 1024; //��λK
		}

		if ($max_size > 0)
		{
			$dump->max_size = $max_size * 1024;
		}
		/* ��ȡҪ���������б� */
		$type = empty($_POST['type']) ? '' : trim($_POST['type']);
		$tables = array();
		switch ($type)
		{
			case 'full':
				
				$query = $db->query("SHOW TABLES LIKE '" .$GLOBALS['table_prefix']. "%'");
				while($t=$db->fetch_array($query))
				{
					$table=array_values($t);
					$tables[$table[0]]=-1;
				}

				$dump->put_tables_list($run_log, $tables);
				break;

			case 'stand':
				$temp = array('site','user','groups ','score');
				foreach ($temp AS $table)
				{
					$tables[$GLOBALS['table_prefix'] . $table] = -1;
				}
				$dump->put_tables_list($run_log, $tables);
				break;

			case 'min':
				$temp = array('site');
				foreach ($temp AS $table)
				{
					$tables[$GLOBALS['table_prefix'] . $table] = -1;
				}
				$dump->put_tables_list($run_log, $tables);
				break;
			case 'custom':
				foreach ($_POST['customtables'] AS $table)
				{
					$tables[$table] = -1;
				}
				$dump->put_tables_list($run_log, $tables);
				break;
		}
		/* ��ʼ���� */
		$tables = $dump->dump_table($run_log, $vol);
		
		if ($tables === false)
		{
			die($dump->errorMsg());
		}
		if (empty($tables))
		{
			/* ���ݽ��� */
			if ($vol > 1)
			{
				/* �ж���ļ� */
				if (!@writefile(ROOT_PATH .'data/sqlbackup/' . $sql_file_name . '_' . $vol . '.sql', $dump->dump_sql))
				{
					sheader('index.php?con=database&act=backup',3,$sql_file_name . '_' . $vol . '.sql�ļ�д��ʧ��','redirect',true);
				}
				$list = array();
				for ($i = 1; $i <= $vol; $i++)
				{
					$list[] = array('name'=>$sql_file_name . '_' . $i . '.sql', 'href'=>'data/sqlbackup/' . $sql_file_name . '_' . $i . '.sql');
				}
				sheader('index.php?con=database&act=restore',3, '�ļ��������','redirect',true);
			}
			else
			{
				/* ֻ��һ���ļ� */
				if (!@writefile(ROOT_PATH .'data/sqlbackup/' . $sql_file_name . '.sql', $dump->dump_sql))
				{
					sheader('index.php?con=database&act=backup',3,$sql_file_name . '_' . $vol . '.sql�ļ�д��ʧ��','redirect',true);
				};

				$list=array(array('name' => $sql_file_name . '.sql', 'href' => 'data/sqlbackup/' . $sql_file_name . '.sql'));
				sheader('index.php?con=database&act=restore',3, '�ļ��������','redirect',true);
			}
		}
		else
		{
			/* ��һ��ҳ�洦�� */
			if (!@writefile(ROOT_PATH .'data/sqlbackup/' . $sql_file_name . '_' . $vol . '.sql', $dump->dump_sql))
			{
				sheader('index.php?con=database&act=backup',3,$sql_file_name . '_' . $vol . '.sql�ļ�д��ʧ��','redirect',true);
			}

			$lnk = 'index.php?con=database&act=dumpsql&sql_file_name=' . $sql_file_name . '&vol_size=' . $max_size . '&vol=' . ($vol+1);
			sheader($lnk,3,$sql_file_name . '_' . $vol . '.sql�ļ�д��ɹ�,������һ���ļ�','redirect',true);
		}
	}




	function return_bytes($m)
	{
		return $m*1024*1024;
	}
	function file_mode_info($path)
	{
		return is_dir($path) && is_writable($path);
	}
	/**
	 * ���ֽ�ת�ɿ��Ķ���ʽ
	 *
	 * @access  public
	 * @param
	 *
	 * @return void
	 */
	function num_bitunit($num)
	{
		$bitunit = array(' B',' KB',' MB',' GB');
		for ($key = 0, $count = count($bitunit); $key < $count; $key++)
		{
		   if ($num >= pow(2, 10 * $key) - 1) // 1024B ����ʾΪ 1KB
		   {
			   $num_bitunit_str = (ceil($num / pow(2, 10 * $key) * 100) / 100) . " $bitunit[$key]";
		   }
		}

		return $num_bitunit_str;
	}
	/**
	 *
	 *
	 * @access  public
	 * @param
	 *
	 * @return void
	 */
	function sql_import($sql_file)
	{
		$db_ver  = $GLOBALS['db']->version();

		$sql_str = array_filter(file($sql_file), 'remove_comment');
		$sql_str = str_replace("\r", '', implode('', $sql_str));

		$ret = explode(";\n", $sql_str);
		$ret_count = count($ret);
		/* ִ��sql��� */
		if ($db_ver > '4.1')
		{
			
			for($i = 0; $i < $ret_count; $i++)
			{
				$ret[$i] = trim($ret[$i], " \r\n;"); //�޳�������Ϣ
				if (!empty($ret[$i]))
				{
					if ((strpos($ret[$i], 'CREATE TABLE') !== false) && (strpos($ret[$i], 'DEFAULT CHARSET=gbk')=== false))
					{
						/* ����ʱȱ DEFAULT CHARSET=gbk */
						$ret[$i] = $ret[$i] . ' DEFAULT CHARSET=gbk';
					}
					$GLOBALS['db']->query($ret[$i]);
				}
			}
		}
		else
		{
			for($i = 0; $i < $ret_count; $i++)
			{
				$ret[$i] = trim($ret[$i], " \r\n;"); //�޳�������Ϣ
				if ((strpos($ret[$i], 'CREATE TABLE') !== false) && (strpos($ret[$i], 'DEFAULT CHARSET=gbk')!== false))
				{
					$ret[$i] = str_replace('DEFAULT CHARSET=gbk', '', $ret[$i]);
				}
				if (!empty($ret[$i]))
				{
					$GLOBALS['db']->query($ret[$i]);
				}
			}
		}

		return true;
	}

}
/**
 *
 *
 * @access  public
 * @param
 * @return  void
 */
function remove_comment($var)
{
    return (substr($var, 0, 2) != '--');
}