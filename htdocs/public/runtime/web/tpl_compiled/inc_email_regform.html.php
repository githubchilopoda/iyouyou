<div class="regist_form">
				<form name="email_reg" action="<?php
echo parse_url_tag("u:user#doregist|"."type=email".""); 
?>" method="post">
					<div class="field">
							<span class="field_title">用户名</span>
							<span class="field_content">
							<input type="text"  class="ui-textbox"  holder="请输入用户名" name="user_name" size="30">
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<div class="field">
							<span class="field_title">登录邮箱</span>
							<span class="field_content">
							<input type="text"  class="ui-textbox"  holder="请输入常用邮箱" name="email" size="30">
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<div class="field">
							<span class="field_title">登录密码</span>
							<span class="field_content">
							<input type="password"  class="ui-textbox"  holder="请输入登录密码" name="user_pwd" size="30">
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<div class="field">
							<span class="field_title">确认密码</span>
							<span class="field_content">
							<input type="password"  class="ui-textbox"  holder="请再次输入登录密码" name="cfm_user_pwd" size="30">
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<div class="field">
							<span class="field_title"></span>
							<span class="field_content">
							<input type="text"  class="ui-textbox"  holder="验证码" name="user_verify" size="20" style="width:80px; float:left;">
							<span style="margin-left:10px; float:left;" id="reg_verify_img"><?php 
$k = array (
  'name' => 'verifyimg',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?></span>
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<div class="field">
							<span class="field_title"></span>
							<span class="field_content">
							<input type="checkbox" name="agree" style="vertical-align: middle;" value="1" /> 我已经阅读，并同意遵守《<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SITE_NAME',
);
echo $k['name']($k['v']);
?>用户服务协议》
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<div class="field">
							<span class="field_title"></span>
							<span class="field_content">
							<a href="javascript:void(0);" class="regist_btn long_btn">立即注册</a>
							<input type="submit" style="display:none;" />
							</span>
							<span class="field_tip"></span>
					</div>
					<div class="blank"></div>
					<?php echo $this->fetch('inc/agreement.html'); ?>
				</form>
			</div>