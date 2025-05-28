<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Surat</h3>
    </div>

    <div class="title_right">
      <div class="col-md-5 col-sm-5 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" id="searchInput" class="form-control" placeholder="Cari surat...">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="x_panel" style="min-height: 600px;">
        <div class="x_title">
          <div class="clearfix">
            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php elseif (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

          </div>
        </div>

        <div class="x_content">
          <div class="row">
            <div class="col-md-12">
              <div class="row" id="suratContainer">
                <?php foreach ($suratList as $surat): ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 surat-card" data-nama="<?= strtolower($surat['nama']) . ' ' . strtolower($surat['deskripsi']) ?>">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                      <div class="card-body text-center">
                        <div class="mb-3">
                          <i class="fas fa-envelope-open-text fa-3x text-success"></i>
                        </div>
                        <h5 class="card-title"><?= esc($surat['nama']) ?></h5>
                        <p class="card-text"><?= esc($surat['deskripsi']) ?></p>
                      </div>
                      <div class="card-footer bg-transparent border-0 text-center">
                        <a href="<?= base_url('/masyarakat/surat/' . esc($surat['slug'])) ?>" class="btn btn-success btn-sm">
                          Ajukan Surat
                        </a>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>



<!-- JS untuk Search Filter -->
<script>
  document.getElementById("searchInput").addEventListener("keyup", function() {
    const keyword = this.value.toLowerCase();
    const cards = document.querySelectorAll(".surat-card");

    cards.forEach(function(card) {
      const nama = card.getAttribute("data-nama");
      if (nama.includes(keyword)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
</script>
<?= $this->endSection() ?>