<?php // TODO: href és src tagok kiratása a routing segítségével! ?>
<div class="wrapper container">
  <div id="container">
    <section id="slider"><img src="/assets/images/fejlec.png" alt=""></section>
    <div id="homepage">
      <section id="services">
        <article class="doboz">
          <figure>
            <a href="ujesemeny.php" class="doboz-link">
              <img class="doboz-kep" src="/assets/images/jatekikon1.png" width="210" height="150" alt="">
            </a>
            <figcaption>
              <h2>Új játék létrehozása</h2>
              <p>Itt tudsz új eseményt létrehozni,<br/> meghirdetni és meghívni rá másokat.</p>
              <footer class="more"><a href="/index.php?' . $this->routeGetName . '=' . $key">Létrehozok</a></footer>
            </figcaption>
          </figure>
        </article>
        <article class="doboz">
          <figure>
            <a href="kereses.php" class="doboz-link">
              <img class="doboz-kep" src="/assets/images/jatekikon2.png" width="210" height="150" alt="">
            </a>
            <figcaption>
              <h2>Keresés a játékok között</h2>
              <p>Itt tudsz böngészni a mások által létrehozott események között, és itt tudsz nevezni, ha szívesen részt
                vennél.</p>
              <footer class="more"><a href="index.php?tartalom=kereses">Keresek</a></footer>
            </figcaption>
          </figure>
        </article>
        <article class="doboz">
          <figure>
            <a href="chat.php" class="doboz-link">
              <img class="doboz-kep" src="/assets/images/forum.jpg" width="210" height="150" alt="">
            </a>
            <figcaption>
              <h2>Chatszoba</h2>
              <p>Itt tudsz csevegni a többiekkel.</p>
              <footer class="more"><a href="index.php?tartalom=chat">Chatszoba</a></footer>
            </figcaption>
          </figure>
        </article>
      </section>
    </div>
  </div>
</div>
