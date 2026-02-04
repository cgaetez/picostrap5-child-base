(function () {
  const KEYS = [
    "utm_source",
    "utm_medium",
    "utm_campaign",
    "utm_term",
    "utm_content",
    "gclid",
    "fbclid",
    "msclkid",
    "ga_client_id",
    "landing_page",
    "referrer",
  ];

  function getParam(name) {
    const url = new URL(window.location.href);
    return url.searchParams.get(name) || "";
  }

  function setField(id, value) {
    if (!value) return;
    const el = document.getElementById(id);
    if (el) el.value = value;
  }

  function saveIfPresent(key, value) {
    if (!value) return;
    try {
      localStorage.setItem(key, value);
    } catch (e) {}
  }

  function loadStored(key) {
    try {
      return localStorage.getItem(key) || "";
    } catch (e) {
      return "";
    }
  }

  // 1) Capture landing + referrer once
  if (!loadStored("landing_page"))
    saveIfPresent("landing_page", window.location.href);
  if (!loadStored("referrer"))
    saveIfPresent("referrer", document.referrer || "");

  // 2) Capture UTMs + click IDs from URL and store
  [
    "utm_source",
    "utm_medium",
    "utm_campaign",
    "utm_term",
    "utm_content",
    "gclid",
    "fbclid",
    "msclkid",
  ].forEach((k) => {
    const v = getParam(k);
    if (v) saveIfPresent(k, v);
  });

  // 3) Fill fields immediately from storage (so it works even if user navigated)
  KEYS.forEach((k) => setField(k, loadStored(k)));

  // 4) Optionally fetch GA4 client_id from gtag if available
  // NOTE: Replace G-XXXXXXXXXX with your GA4 Measurement ID
  const GA_MEASUREMENT_ID = "G-CHS4RW2TYH";

  function fillClientIdFromGtag() {
    if (typeof window.gtag !== "function") return;

    window.gtag("get", GA_MEASUREMENT_ID, "client_id", function (clientId) {
      if (clientId) {
        saveIfPresent("ga_client_id", clientId);
        setField("ga_client_id", clientId);
      }
    });
  }

  fillClientIdFromGtag();

  // 5) CF7 can render via AJAX; re-fill on CF7 init just in case
  document.addEventListener(
    "wpcf7init",
    function () {
      KEYS.forEach((k) => setField(k, loadStored(k)));
      fillClientIdFromGtag();
    },
    false
  );
})();
