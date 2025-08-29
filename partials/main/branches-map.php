<?php
  $query = [
    'post_type' => 'cpt-branches',
    'post_status' => 'publish',
    'posts_per_page' => -1
  ];

  $result = new WP_Query($query);
?>

<div id="branches-map" class="row">
  <div class="col-lg-5 d-none d-lg-block map px-0">
    <?php get_template_part("partials/main/branches-map/map"); ?>
  </div>

  <div class="col-12 col-lg-2 bg-primary py-3">
    <?php get_template_part("partials/main/branches-map/branch-buttons", null, [
      'result' => $result
    ]); ?>
  </div>

  <div class="col-12 col-lg-5 px-0">
    <?php get_template_part("partials/main/branches-map/branch-infos", null, [
      'result' => $result
    ]); ?>
  </div>
</div>

<script>
  class BranchesMap {
    constructor() {
      this.root = '#branches-map';
      this.branchButtons = [...document.querySelectorAll(`${this.root} .branch-button`)];
      this.branchMarkers = [...document.querySelectorAll(`${this.root} .branch-marker`)];
      this.branchInfos = [...document.querySelectorAll(`${this.root} .branch-info`)];

      this.initialize();
    }

    initialize() {
      this.clear(true);

      this.branchButtons.forEach(e => e.addEventListener('click', () => this.branchButtonClick(e)));
      this.branchMarkers.forEach(e => {
        [...e.children].forEach(c => c.addEventListener('click', () => this.branchMarkerClick(e)))
      });
    }

    clear(skipBranchInfos) {
      this.branchButtons.forEach(e => e.classList.remove('text-warning'));
      this.branchMarkers.forEach(e => {
        e.children[0].style.fill = 'var(--bs-dark)'
        e.children[1].style.fill = 'var(--bs-danger)';
      });

      if (!skipBranchInfos)
        this.branchInfos.forEach(e => e.classList.add('d-none'));
    }

    branchMarkerClick(marker) {
      this.clear();

      const branchName = marker.id.replace('-marker', '');

      this.showBranch(branchName);
    }

    branchMarkerDotClick(markerDot) {
      this.clear();

      const branchName = markerDot.id.replace('-marker-dot', '');

      this.showBranch(branchName);
    }

    branchButtonClick(btn) {
      this.clear();

      const branchName = btn.id.replace('-btn', '');

      this.showBranch(branchName);
    }

    showBranch(branchName) {
      this.branchButtons.find(e => e.id == `${branchName}-btn`).classList.add('text-warning');
      const marker = this.branchMarkers.find(e => e.id == `${branchName}-marker`);

      marker.children[0].style.fill = 'var(--bs-warning)';
      marker.children[1].style.fill = 'var(--bs-warning)';

      this.branchInfos.find(e => e.id == `${branchName}-info`).classList.remove('d-none');
    }
  }

  const branchesMap = new BranchesMap();
</script>
