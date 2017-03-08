<div class="wrapper cim">
  <header id="header">
    <a href="/" id="hgroup">
      <h1>Társasjátékszervező</h1>
      <h2>Találj magadnak játékostársakat itt!</h2>
    </a>
    <div>
      <?php if ($this->user): ?>
        Bejelentkezve:
        <?= $this->user['fullname'] ?>
        <div>
          <a href="<?= $this->routing->getRoute('profil_kijelentkezes') ?>">
            Kijelentkezés
          </a>
        </div>
      <?php endif; ?>
    </div>
    <nav>
      <ul>
        <?php if ($this->user): ?>
          <li><a href="<?= $this->routing->getRoute('profil_modositas') ?>">Profil módosítása</a></li>
        <?php endif; ?>
        <?php if (!$this->user): ?>
          <li><a href="<?= $this->routing->getRoute('profil_regisztracio') ?>">Regisztráció</a></li>
        <?php endif; ?>
        <li><a href="<?= $this->routing->getRoute('profil_bejelentkezes') ?>">Bejelentkezés</a></li>
        <li>
          <a href="<?= $this->routing->getRoute('igy_mukodik') ?>">
            Így működik
          </a>
        </li>
      </ul>
    </nav>
  </header>
</div>
