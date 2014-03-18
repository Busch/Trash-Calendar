<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.html'; ?>

<!-- Javascript ================================================== -->

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://stats.datenschleuder.com/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "6"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->

</head>

<div class="container">

<!-- Masthead ================================================== -->
<?php include 'masthead.html'; ?>

<!-- Typography ================================================== -->
<section id="typography">
  <div class="row">
    <div class="span4">
        <br>
        <b>
          <p>Dies war ein Erinnerungsservice für die GOA Müllabfuhr im Ostalbkreis.</p>
          <p>Die GOA und das Landratsamt Aalen haben darauf verzichtet mein System als kostenlosen Bürgerservice anzunehmen und haben sich stattdessen für ein teuer erkauftes System entschieden.</p>
        </b>

        <p>Hinzu kommt, dass Sie durch das neue System diverse Nachteile in Kauf nehmen müssen. Dazu gehört u.a.:</p>
        <ul>
          <li>Sie können nur <b>alle</b> Müllarten auf einmal abonnieren</li>
          <li>Sie haben <b>keine</b> Möglichkeit eine Erinnerung/Alarm einzustellen</li>
          <li>Die Abfuhrtermine werden mit Ihren privaten Terminen vermischt</li>
          <li>Von geänderten Abfuhrterminen müssen Sie sich wieder traditionell aus der Tageszeitung informieren</li>
          <li>Der Kalender kann sich nicht automatisch erneuern und muss daher jedes Jahr aufs neue abonniert werden</li>
          <li>Wenn Sie die Abfuhrtermine wieder los haben wollen müssen Sie <b>jeden einzelnen</b> Termin manuell aus Ihrem Endgerät entfernen</li>
        </ul>
        <br>
        <p>Sie können sich <a href="http://www.goa-online.de/kontakt/kontakt.html" target="_blank">hier</a> bei der GOA hierfür herzlich bedanken. Der neue GOA Müllkalender kann <a href="http://www.goa-online.de/abfuhrkalender/termine-auswahl.html" target="_blank">hier</a> abonniert werden.</p>
    </div>
  </div>
</section>
    <hr>
 <!-- Footer ================================================== -->
      <footer id="footer">
        <?php include 'footer.html'; ?>
      </footer>
    </div>
  </body>
</html>
