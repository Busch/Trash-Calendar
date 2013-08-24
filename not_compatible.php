<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'header.html'; ?>
  </head>

<!-- Javascript ================================================== -->

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://stats.datenschleuder.com/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "1"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->

<div class="container">

<!-- Masthead ================================================== -->
<?php include 'masthead.html'; ?>

<!-- Typography ================================================== -->
<section id="typography">
  <div class="row">
    <div class="span4">
      <span style="color:#FF0000"><h3>Sorry...</h3></span>
        <p>Es tut uns leid. Sie müssen diese Seite mit Ihrem iPhone, iPod oder iPad besuchen.</p>
        <p>Der Erinnerungsservice funktioniert (bisher) leider nur für iPod, iPhone und iPad.</p>
        <p>Windows Phone wird vermutlich ab 01.01.2014 unterstützt. Android ist leider nicht kompatibel.</p>
      <br>
      <h3>Info</h3>
        <p>Dies ist ein Erinnerungsservice für die GOA Müllabfuhr im Ostalbkreis. Einfach den Bezirk und die Strasse auswählen, um die Abfuhrtermine in den Kalender zu importieren.</p>
        <p>Die Kalenderdaten beinhalten die Hausmüllabfuhr, Gelber Sack, Bioabfall, Blaue Tonne, Grünabfuhr sowie die Altpapiersammlung der Vereine.</p>
        <p>Aktuell sind alle Daten bis einschließlich 31.03.2014 enthalten - die Daten für die darauf folgenden Jahre werden automatisch mit eingepflegt, sobald diese von der GOA zur Verfügung gestellt werden. Eine Erinnerung erfolgt immer am vorherigen Tag um 18:00 Uhr.</p>
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
