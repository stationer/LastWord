<?php get_header(); ?>
		<div class="lastWord">

<!--
<h1>Due to lack of adoption, LastPassWord.Net will be shut down on Feburary 19, 2011.</h1>
<p>Contact sysop@lastpassword.net before then if you have questions.</p>
<p>Password Managers you may consider switching to include <a href="http://lastpass.com/">LastPass.com</a> and <a 
href="http://keepass.info/">KeePass</a>.</p>

			<div class="right clear"  style="width:200px;margin:10px;padding-left:10px;border-left:1px solid black;">
				<p><b><span class="lwtg_hide" onmouseover="lwtg_show(this);" onmouseout="lwtg_hide(this);"><a href="javascript:lpw_s1=document.createElement('script');lpw_s1.type='text/javascript';lpw_s1.src='/lastword_remote.js';lpw_s1.id='lpw_s1';document.body.appendChild(lpw_s1);void(0);">LastPassWord.Net To Go!</a></span></b>
					- Save this JavaScript link as a 
					bookmark to get your passwords while on other sites.
				</p>
				<p><b>One Click Logins</b> - Once you've entered your Master Key, 
					you can even login to supporting sites directly from the form
					with one click!  Just click the 
					<img src="/images/right.png" alt="right"> icon.
				</p>
			</div>
-->
			<h2>What is "Last Word"?</h2>
			<p>Last Word is a password management system that works by assigning
				passwords rather than storing them.  The advantage is that your
				passwords are not stored anywhere to be found.  The disadvantage
				is that you cannot choose your own passwords.  The process is
				simple, as discribed below:
			</p>
			<h2>1. Add the accounts you want to manage</h2>
			<p>You'll notice how the form does not have a field for your password --
				we do things a little different.  Enter the name of the Service
				you want to access, your username on that service, and the URL 
				of the login page (for your convenience).
			</p>
			<h2>2. Enter your Super-Secret Master Key</h2>
			<p>This Master Key is critical, make sure that it is not too simple,
				but still something you will never forget. If you forget this
				Master Key, there is no help for recovery. Be sure that no one
				else knows it, either, because changing your Master Key means
				changing all your passwords.
			</p>
			<h2>3. View your passwords here</h2>
			<p>After you have correctly entered your Master Key, your passwords
				are displayed in this table.  These passwords are NOT STORED
				ANYWHERE.  Not in our database, not in your computer, nowhere!
				Set your accounts to use these passwords, then you can always
				refer back to this list after providing the same Master Key
				that you used to create this list.
			</p>
			<p>Notice that entering an incorrect
				Master Key will still display passwords, they are just not the
				correct passwords.  Only you know when the correct passwords
				are displayed, because only you know your Master Key.
			</p>
			<p>To protect against people looking over your shoulder, passwords
				are obscured until you mouseover them, and a "copy" link is
				provided that will copy the password directly to the clipboard
				for you to paste into the service's login form.
			</p>
			<p><a href="/LastWord/list">View your list</a></p>
		</div>
<?php get_footer(); ?>
