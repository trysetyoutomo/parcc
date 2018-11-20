#nav-bar { border-top:1px solid #2d444f; 
border-bottom:1px solid #2d444f; 
padding:0 30px; 
background-size:100px 100px;
 }
#nav { float:left; margin:0;list-style-image:none;list-style-position:outside;list-style-type:none;margin:0;padding:0;}

/************** ALL LEVELS  *************/
#nav li { position:relative; text-align:left; }
#nav li.over { z-index:99; }
#nav li.active { z-index:100; }
#nav a,
#nav a:hover { display:block; text-decoration:none; }
#nav span { display:block; }
#nav a { line-height:1.3em; }


/************ 1ST LEVEL  ***************/
#nav li { float:left; background:url(nav1_sep.gif) no-repeat 100% 0;  }
#nav li.active { margin-left:-1px; background:url(nav1_active.gif) no-repeat; color:#fff; font-weight:bold;  }
#nav li.active em { display:block; position:absolute; top:0; right:-1px; width:3px; height:27px; background:url(nav1_active.gif) no-repeat 100% 0; }
#nav a { float:left; padding:0 14px; color:#fff; line-height:27px; }
#nav li.over a { color:#d6e2e5; }


/************ 1ST LEVEL RESET ************/
#nav ul li,
#nav ul li.active { list-style-image:none;list-style-position:outside;list-style-type:none;margin:0;padding:0; float:none; height:auto; background:none; margin:0; }
#nav ul a,
#nav ul a:hover { float:none; padding:0; line-height:1.3em; }
#nav ul li.over a,
#nav ul li.over a:hover,
#nav ul a,
#nav li.active li { font-weight:normal; }


/************ 2ND LEVEL ************/
#nav ul { list-style-image:none;list-style-position:outside;list-style-type:none;margin:0;padding:0 0 3px 0; position:absolute; width:189px; top:27px; left:-10000px; border-top:1px solid #2d444f; }
#nav ul ul  { list-style-image:none;list-style-position:outside;list-style-type:none;margin:0;padding:2px 0 0 0; border-top:0; background:url(nav3_bg.png) 0 0 no-repeat; left:100px; top:13px; }

/* Show menu */
#nav li.over ul { left:-1px; }
#nav li.over ul ul { left:-10000px; }
#nav li.over ul li.over ul { left:100px; }

#nav ul li { background:url(nav2_li_bg.png) repeat-y; padding:0 2px; }
#nav ul li a { background:#e3ecee; }
#nav ul li a:hover { background:#d0dfe2; }
#nav li.over ul a,
#nav ul li.active a,
#nav ul li a,
#nav ul li a:hover { color:#2f2f2f; }
#nav ul span,
#nav ul li.last li span { padding:5px 15px; background:url(nav2_link_bg.gif) repeat-x 0 100%; }
#nav ul li.last span,
#nav ul li.last li.last span { background:none; }
#nav ul li.last { background:url(nav2_last_li_bg.png) no-repeat 0 100%; padding-bottom:3px; }

#nav ul li.parent a,
#nav ul li.parent li.parent a { background-image:url(nav2_parent_arrow.gif); background-position:100% 100%; background-repeat:no-repeat; }
#nav ul li.parent li a,
#nav ul li.parent li.parent li a { background-image:none; }

/************ 3RD+ LEVEL ************/
/* Cursors */
#nav li.parent a,
#nav li.parent li.parent a,
#nav li.parent li.parent li.parent a { cursor:default; }

#nav li.parent li a,
#nav li.parent li.parent li a,
#nav li.parent li.parent li.parent li a { cursor:pointer; }

/* Show menu */
#nav ul ul ul { left:-10000px; list-style-image:none;list-style-position:outside;list-style-type:none;margin:0;padding:0; }
#nav li.over ul li.over ul ul { left:-10000px;}
#nav li.over ul li.over ul li.over ul { left:100px; }

#nav-bar:after, #nav-container:after { content:"."; display:block; clear:both; font-size:0; line-height:0; height:0; overflow:hidden; }