// Using event delegation https://gomakethings.com/why-event-delegation-is-a-better-way-to-listen-for-events-in-vanilla-js/#web-performance
document.addEventListener(
  "click",
  function (event) {
    // Mobile Menu Toggle
    if (event.target.matches(".site-toggle")) {
      if (event.target.classList.contains("active")) {
        removeClass(".site-toggle, .site-nav-m", "active");
        removeClass("#page", "show-nav");
      } else {
        addClass(".site-toggle, .site-nav-m", "active");
        addClass("#page", "show-nav");
      }
    }
    if (event.target.matches("#site-nav-m .menu-item-has-children > .submenu-toggle")) {
      // Toggle the 'active' class on the parent of the clicked element
      event.target.parentNode.classList.toggle("active");
      // Stop the event from propagating up to parent elements
      event.stopPropagation();
    }
    // Close menu on click (useful for One Page Website)
    if (event.target.matches("#site-nav-m a")) {
      if (event.target.getAttribute("href") == "#") {
        if (event.target.parentNode.classList.contains("active")) {
          event.target.parentNode.classList.remove("active");
        } else {
          event.target.parentNode.classList.add("active");
        }
      } else {
        removeClass(".site-toggle, .site-nav-m", "active");
      }
    }
    // Search
    if (event.target.matches(".site-search")) {
      document.getElementById("s").focus();
    }
    // Close Search Modal
    if (event.target.matches(".s-modal-close")) {
      document.getElementById("s").blur();
    }
  },
  false
);

// Mobile Menu - Add Dropdown Toggle
document
  .querySelectorAll("#site-nav-m .menu-item-has-children")
  .forEach((e) => {
    e.insertAdjacentHTML(
      "beforeend",
      '<div class="plus submenu-toggle"><b></b></div>'
    );
  });
// Desktop Menu - Add Dropdown Toggle on level 2
document
  .querySelectorAll(".site-nav-d .sub-menu .menu-item-has-children")
  .forEach((e) => {
    e.insertAdjacentHTML(
      "beforeend",
      '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>'
    );
  });
// Slider
function createSlider(slider_id, view_m, view_d, center_m, center_d) {
  var slider_wrapper = document.getElementById(slider_id);
  var content = slider_wrapper.innerHTML;
  new_content = "<div class='slider-area'>" + content + "</div>";
  slider_wrapper.innerHTML = new_content;
  var slider = slider_wrapper.getElementsByClassName("slider-area")[0];
  var show = new KeenSlider(slider, {
    loop: true,
    slides: ".slider",
    slidesPerView: view_m,
    centered: center_m,
    breakpoints: {
      "(min-width: 992px)": {
        slidesPerView: view_d,
        centered: center_d,
      },
    },
    created: function (instance) {
      var nav_wrapper = document.createElement("div");
      var nav_prev = document.createElement("a");
      var nav_next = document.createElement("a");
      nav_wrapper.classList.add("nav");
      nav_prev.classList.add("prev");
      nav_next.classList.add("next");
      slider_wrapper.appendChild(nav_wrapper);
      nav_wrapper.appendChild(nav_prev);
      nav_wrapper.appendChild(nav_next);
      slider_wrapper
        .getElementsByClassName("prev")[0]
        .addEventListener("click", function () {
          instance.prev();
        });
      slider_wrapper
        .getElementsByClassName("next")[0]
        .addEventListener("click", function () {
          instance.next();
        });
      var dots_wrapper = document.createElement("div");
      dots_wrapper.classList.add("dots");
      slider_wrapper.appendChild(dots_wrapper);
      var slides = slider.querySelectorAll(".slider");
      slides.forEach(function (t, idx) {
        var dot = document.createElement("a");
        dot.classList.add("dot");
        dots_wrapper.appendChild(dot);
        dot.addEventListener("click", function (event) {
          instance.moveToSlide(idx);
        });
      });
      updateClasses(instance);
    },
    slideChanged(instance) {
      updateClasses(instance);
    },
  });
  function updateClasses(instance) {
    var slide = instance.details().relativeSlide;
    var dots = slider_wrapper.querySelectorAll(".dot");
    dots.forEach(function (dot, idx) {
      idx === slide
        ? dot.classList.add("active")
        : dot.classList.remove("active");
    });
  }
}

var sliders = document.querySelectorAll(".s-slider");
if (sliders) {
  for (var i = 0, len = sliders.length; i < len; i++) {
    var slider = sliders[i];
    var slider_id = "s-slider-" + i;
    slider.setAttribute("id", slider_id);
    var view_m = 1;
    var view_d = 0;
    var center_m = false;
    var center_d = false;
    for (var j = 0; j < slider.classList.length; j++) {
      slider_class = slider.classList.item(j);
      if (
        slider_class.substring(0, 2) === "-d" &&
        slider_class.substring(0, 4) != "-dot"
      ) {
        view_d = slider_class.substring(2);
      } else {
        if (slider_class.substring(0, 2) === "-m") {
          view_m = slider_class.substring(2);
        }
      }
      if (slider_class.substring(0, 9) === "-center-m") {
        center_m = true;
      }
      if (slider_class.substring(0, 9) === "-center-d") {
        center_d = true;
      }
    }
    if (view_d == 0) {
      view_d = view_m;
    }
    createSlider(slider_id, view_m, view_d, center_m, center_d);
  }
}



var lang_switcher = document.querySelectorAll(".language-switcher");
if(lang_switcher) {
  lang_switcher.forEach((e) => {
    var toggle = e.querySelector("ul");
    if(toggle) { 
      var target = toggle.querySelector(".wpml-ls-sub-menu");
      var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutationRecord) {
          if(target.style.visibility === "" || target.style.visibility === "visible") { 
            toggle.classList.add("active");
          }else { 
            toggle.classList.remove("active");
          }
        });    
      });
      observer.observe(target, { 
        attributes: true, 
        attributeFilter: ['style'] 
      });
      // Add Chevdown
      toggle.querySelector(".wpml-ls-item-toggle").insertAdjacentHTML(
        "beforeend",
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>'
      );
    }
  });
}

// Tab of News section on Homepage.
function showTabContent(catId) {
  var allElements = document.querySelectorAll('.latest-news .s-grid, .latest-news .s-slider');
  if (allElements) {
    allElements.forEach(function(element) {
      element.style.display = 'none';
    });
  }
  var gridElement = document.getElementById('grid-' + catId);
  var sliderElement = document.querySelector('[data-slider="slider-' + catId + '"]');
  if (gridElement) {
    gridElement.style.display = 'grid';
  }
  if (sliderElement) {
    sliderElement.style.display = 'block';
  }
}

var defaultActiveTab = document.querySelector('.latest-news .tab-item.active');
if (defaultActiveTab) {
  var defaultCatId = defaultActiveTab.getAttribute('data-cat');
  showTabContent(defaultCatId);
}

var tabs = document.querySelectorAll('.latest-news .tab-item');
if (tabs) {
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      tabs.forEach(function(t) {
          t.classList.remove('active');
      });
      this.classList.add('active');
      var catId = this.getAttribute('data-cat');
      showTabContent(catId);
    });
  });
}

var history = document.querySelectorAll('.history');
if (history.length > 0) {
    var sections = document.querySelectorAll('.history .s-grid');

    function updateActiveSections() {
        let activeIndex = -1;
        sections.forEach((section, index) => {
            var rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.5 && rect.bottom > 0) {
                activeIndex = index;
            }
        });
        sections.forEach((section, index) => {
            if (index <= activeIndex) {
                section.classList.add('active');
            } else {
                section.classList.remove('active');
            }
        });
        updateProgress();
    }
    function updateProgress() {
      var dots = document.querySelectorAll('.history .dot');
      var progress = document.querySelector('.history .progress');
      var historyElement = document.querySelector('.history');
      if (!progress || dots.length === 0 || !historyElement) return;
  
      var historyRect = historyElement.getBoundingClientRect();
      var firstDotRect = dots[0].getBoundingClientRect();
      var activeIndex = -1;
  
      for (let i = 0; i < sections.length; i++) {
          if (sections[i].classList.contains('active')) {
              activeIndex = i;
          }
      }
  
      if (activeIndex !== -1 && activeIndex < dots.length - 1) {
          var nextDotRect = dots[activeIndex + 1].getBoundingClientRect();
          var progressHeight = nextDotRect.bottom - historyRect.top - (firstDotRect.top - historyRect.top);
          progress.style.height = `${progressHeight}px`;
      }else if (activeIndex === -1) {
          progress.style.height = '0px';
      }
    }

    function handleScroll(event) {
        updateActiveSections();
    }

    document.addEventListener('scroll', handleScroll);
    updateActiveSections(); // Initial update when the page loads

    function updateTimelineLineHeight() {
      var timelineLine = document.querySelector('.history .timeline-line');
      var dots = document.querySelectorAll('.history .dot');
      if (!timelineLine || dots.length === 0) return;

      var lastDotRect = dots[dots.length - 1].getBoundingClientRect();
      var timelineLineTop = timelineLine.getBoundingClientRect().top;
      var heightToLastDot = lastDotRect.bottom - timelineLineTop;

      timelineLine.style.height = `${heightToLastDot}px`;
    }
    updateTimelineLineHeight();
    window.addEventListener('resize', updateTimelineLineHeight);
}


var internship = document.querySelector('.slider-custom-nav');
if (internship) {
  var prev = internship.querySelector('.prev');
  var next = internship.querySelector('.next');
    prev.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>';
    next.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>';
}




var navs = document.querySelectorAll('.page-template-default-with-nav .template-navigation-mobile');
if (navs) {
  navs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      this.classList.toggle('active');
    });
  });
}



var board = document.querySelectorAll(".site-board");
  if(board) { 
    board.forEach((e) => {
      e.addEventListener("click", function() { 
        var name = e.dataset.name;
        var position = e.dataset.position;
        var background = e.dataset.background;
        var img = e.dataset.img;

        var modal = document.getElementById("board_modal");
            modal.querySelector("#board_image").src = img;
            modal.querySelector("#board_name").innerHTML = name;
            modal.querySelector("#board_position").innerHTML = position;
            modal.querySelector("#board_background").innerHTML = background;
      });
    });
  }
  


function createChart(chartID, barData = [], label = []){ 

  const ctx = document.getElementById(chartID).getContext('2d');
  const maxValue = Math.max(...barData.map(d => d.value));
  const pixelToValueRatio = maxValue / ctx.canvas.height;
  const offsetInPixels = 130;
  const offsetValue = pixelToValueRatio * offsetInPixels;

  const trendDataset = {
      type: 'line',
      label: 'Trend',
      data: barData.map(d => ({ x: barData.indexOf(d), y: d.value + offsetValue })),
      borderColor: '#BDBDBD',
      borderDash: [2, 1],
      borderWidth: 1,
      pointBorderColor: '#FF5722',
      pointBackgroundColor: '#FF5722',
      pointRadius: 5,
      backgroundColor: 'transparent',
      fill: false,
      tension: 0,
      datalabels: {
          display: true,
          color: '#FF5722',
          formatter: function(value, context) {
              return barData[context.dataIndex].trend + '%';
          },
          align: 'top',
          offset: 10
      }
  };

  const barDataset = {
      type: 'bar',
      label: 'Values',
      data: barData.map(d => d.value),
      backgroundColor: function(context) {
          const index = context.dataIndex;
          const count = context.dataset.data.length;
          return index === count - 1 ? '#003955' : '#E0E0E0';
      },
      barThickness: 35,
      datalabels: {
          display: true,
          color: '#000',
          anchor: 'end',
          align: 'top',
          font: {
              size: 12,
              weight: 500
          },
          offset: 10,
          formatter: function(value, context) {
              return value.toLocaleString(); // Display numeric value
          }
      }
  };

  const chartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
          x: {
              type: 'category',
              grid: {
                  display: false
              }
          },
          y: {
              display: false
          },
      },
      plugins: {
          tooltip: {
              enabled: false
          },
          datalabels: {
              anchor: 'end',
              align: 'top'
          },
          legend: {
              display: false
          },
      },
      layout: {
          padding: {
              top: 50,  
          }
      }
  };

  const chartData = {
      labels: label,
      datasets: [barDataset, trendDataset]
  };

  Chart.register(ChartDataLabels);
  new Chart(ctx, {
      type: 'bar',
      data: chartData,
      options: chartOptions
  });
}
function createAnimation(json, elem, linkID) { 
  var animationContainer = document.getElementById(elem);
  var linkElement = document.getElementById(linkID); 
  var animation = lottie.loadAnimation({
      container: animationContainer, 
      renderer: 'svg',
      loop: false,
      autoplay: false,
      path: json
  });

  linkElement.addEventListener('mouseenter', function() {
    animation.setDirection(1); 
    animation.setSpeed(1);
    animation.goToAndPlay(0); 
  });

  linkElement.addEventListener('mouseleave', function() {
    animation.setDirection(-1);
    animation.setSpeed(1.5);
    animation.play(); 
  });
}

