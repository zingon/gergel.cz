{* sablona newsletteru *}
{* dokument s objednavkou - detail objednavky, nebo obsah mailu *}	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="cs" />

  </head>
  <body style="color: #343434; text-align: left; font-family: Arial, sans-serif; line-height: 1.5; font-size: 10pt;">
    <div class="header" style="height:75px; background-color: #F8F8F8; border-bottom: 4px solid #eb2941;">
       <img src="{$media_path}img/newsletter_logo.jpg" style="float: left;" />
    </div>
    
    {$body}
    
    <div class="unsubscribeLink" style="line-height: 30px; border-top: 1px solid #000;">
       Odhlásit z odběru newsletteru se můžete <a href="http://zoolesna.dgsbeta.cz/newsletter_unsubscribe?user_h={$email_hash}">zde</a>.
    </div>
    
    <div class="footer" style="line-height: 30px; height: 30px; border-top: 2px solid #35327F;">
       NOVENTIS s.r.o. Filmová 174, 761 79 Zlín, ČR, firma@noventis.cz
    </div>
  </body>
</html>