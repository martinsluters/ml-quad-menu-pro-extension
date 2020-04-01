
# QuadMenu PRO Login Item Extension

Simple QuadMenu Pro extension plugin that overwrites html rendering methods of [QuadMenu](https://wordpress.org/plugins/quadmenu/) and [QuadMenu PRO](https://quadmenu.com/) Login Item.

 - Change placeholder 'Username' to 'Email address' on login form
 - Remove username input field form registration form 
 - Sets e-mail address as the username once registration form is filled and user is being created

## Motive
[QuadMenu PRO](https://quadmenu.com/) does not allow to filter rendered html via WordPress hooks.


## Installation
Plugin requires to be Composer installed


## Requirements
[QuadMenu](https://wordpress.org/plugins/quadmenu/) (v1.9.0) and [QuadMenu PRO](https://quadmenu.com/) (v1.8.4). Might be working with older and newer versions of both plugins.

## Developer information
There are several filters available that do not ship with QuadMenu and QuadMenu PRO by default yet

 - ml_qmpext_login_form_html
 - ml_qmpext_registration_form_html
 - ml_qmpext_set_item_object_class
 - ml_qmpext_register_user_userdata

## Disclaimer
I am not responsible, in any way whatsoever, for your use of the plugin. Use it on your own risk.