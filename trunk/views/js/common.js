function AddFavorite(sURL, sTitle)
{
	try
	{
	window.external.addFavorite(sURL, sTitle);
	}
	catch (e)
	{
		try
		{
		   window.sidebar.addPanel(sTitle, sURL, "");
		}
		catch (e)
		{
		   alert('AddFavorite Failed');
		}
	}
}
function setHomepage(val)
{
	if (document.all) 
	{
		document.body.style.behavior='url(#default#homepage)';
		document.body.setHomePage(val)
	} 
	else if (window.sidebar)
	{
		if(window.netscape)
		{ 
			try
			{ 
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); 
			}
			catch (e)
			{
				window.sidebar.addPanel(val,'',"");
			}
		} 
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
		prefs.setCharPref('browser.startup.homepage',val);
	}
}

function setClipboard(maintext,isalert) 
{
    if (window.clipboardData) 
    {
		if(isalert==true)
		{
			alert("复制成功。现在您可以粘贴（Ctrl+v）到QQ中了。");
		}
        return (window.clipboardData.setData("Text", maintext));
    } 
    else 
    {
        if (window.netscape) 
        {
            try{
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            var clip = Components.classes["@mozilla.org/widget/clipboard;1"].createInstance(Components.interfaces.nsIClipboard);
            if (!clip) 
            {
                return;
            }
            var trans = Components.classes["@mozilla.org/widget/transferable;1"].createInstance(Components.interfaces.nsITransferable);
            if (!trans) 
            {
                return;
            }
            trans.addDataFlavor("text/unicode");
            var str = new Object();
            var len = new Object();
            var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
            var copytext = maintext;
            str.data = copytext;
            trans.setTransferData("text/unicode", str, copytext.length * 2);
            var clipid = Components.interfaces.nsIClipboard;
            if (!clip) 
            {
                return false;
            }
            clip.setData(trans, null, clipid.kGlobalClipboard);
			if(isalert==true)
			{
				alert("复制成功。现在您可以粘贴（Ctrl+v）到QQ中了。");
			}
            return true;
            }
            catch(e)
            {
                alert("您的firefox安全限制限制您进行剪贴板操作，请打开'about:config'将signed.applets.codebase_principal_support'设置为true'之后重试，相对路径为firefox根目录/greprefs/all.js");
                return false;
            }
        }
    }
	
    return false;
}