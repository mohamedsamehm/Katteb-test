document.addEventListener("DOMContentLoaded", function () {
  function generateMonthlyRevenueChart() {
    let xAxis = [];
    let yAxis = [];
    [marketplacLast90Days].map((result) => {
      result.map(({ date }) => {
        if (date) xAxis.push(date);
      });
    });
    [marketplacLast90Days].map((result) => {
      result.map(({ revenue }) => {
        if (revenue) yAxis.push(revenue);
      });
    });

    let chart = echarts.init(
      document.getElementById("monthly-revenue-chart"),
      null,
      {
        height: 100,
      }
    );
    let option = {
      tooltip: {
        trigger: "axis",
        axisPointer: {
          type: "cross",
          label: {
            backgroundColor: "#6a7985",
          },
        },
      },
      grid: {
        left: "5%",
        right: "5%",
        bottom: "3%",
        top: "10",
        containLabel: true,
      },
      xAxis: [
        {
          type: "category",
          boundaryGap: false,
          data: xAxis,
        },
      ],
      yAxis: {
        type: "value",
        boundaryGap: [0, "20%"],
        axisLabel: {
          show: false,
        },
        axisLine: {
          show: false,
        },
        splitLine: {
          show: false,
        },
        axisTick: {
          show: false,
        },
      },
      series: [
        {
          name: "Revenue",
          type: "line",
          stack: "Total",
          smooth: true,
          lineStyle: {
            width: 3,
            color: "#ec3646",
          },
          showSymbol: false,
          areaStyle: {
            opacity: 0.8,
            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
              {
                offset: 0,
                color: "#fce2e5",
              },
              {
                offset: 1,
                color: "#fefefe",
              },
            ]),
          },
          emphasis: {
            focus: "series",
          },
          data: yAxis,
        },
      ],
    };
    option && chart.setOption(option);
  }
  generateMonthlyRevenueChart();

  // Daily Sales Chart
  function generateDailySalesChart() {
    let xAxis = [];
    let yAxis = [];
    [marketplacLast15Days].map((result) => {
      result.map(({ date }) => {
        if (date) xAxis.push(date);
      });
    });
    [marketplacLast15Days].map((result) => {
      result.map(({ sales }) => {
        if (sales) yAxis.push(sales);
      });
    });
    let chart = echarts.init(
      document.getElementById("daily-sales-chart"),
      null,
      {
        height: 100,
      }
    );
    let option = {
      xAxis: {
        type: "category",
        data: xAxis,
        axisLabel: {
          show: false,
        },
        axisLine: {
          show: false,
        },
        splitLine: {
          show: false,
        },
        axisTick: {
          show: false,
        },
      },
      yAxis: {
        type: "value",
        axisLabel: {
          show: false,
        },
        axisLine: {
          show: false,
        },
        splitLine: {
          show: false,
        },
        axisTick: {
          show: false,
        },
      },
      tooltip: {
        trigger: "axis",
        axisPointer: {
          type: "cross",
        },
      },
      grid: {
        left: "5%",
        right: "5%",
        bottom: "0%",
        top: "20",
        containLabel: true,
      },
      series: [
        {
          data: yAxis,
          type: "bar",
          itemStyle: {
            color: "#ec3646",
          },
        },
      ],
    };
    option && chart.setOption(option);
  }
  generateDailySalesChart();

  const elem = document.getElementById("sales-datepicker");
  new DateRangePicker(elem, {
    autohide: true,
    format: "MM d y",
  });

  /* Dropdown */
  //add event listeners
  document
    .querySelectorAll(".sidebar-nav-item.dropdown")
    .forEach((triggerEl) => {
      let toggleTimeout;
      const controlledEl = document.getElementById(
        triggerEl.getAttribute("aria-controls")
      );
      //set height of dropdown section, so we can animate it in css
      const height = controlledEl.firstElementChild.offsetHeight;
      controlledEl.style.height = `${height}px`;

      // prevent focus
      triggerEl.addEventListener("mousedown", (event) => {
        event.preventDefault();
      });

      // toggle view on click
      triggerEl.addEventListener("click", (event) => {
        window.clearTimeout(toggleTimeout);
        if (triggerEl.getAttribute("aria-expanded") === "false") {
          controlledEl.classList.remove("closed", "hide");
          triggerEl.setAttribute("aria-expanded", true);
        } else {
          controlledEl.classList.add("closed");
          triggerEl.setAttribute("aria-expanded", false);
          toggleTimeout = window.setTimeout(() => {
            controlledEl.classList.add("hide");
          }, 300);
        }
      });
    });

  var btnToggleSidebar = document.getElementById("btn-toggle-sidebar");
  var sidebar = document.getElementById("sidebar");
  btnToggleSidebar.addEventListener("click", function (e) {
    e.stopPropagation();
    document.getElementById("sidebar").classList.toggle("show");
  });

  window.addEventListener("click", function () {
    document.getElementById("sidebar").classList.remove("show");
  });

  sidebar.addEventListener("click", function (e) {
    e.stopPropagation();
  });
});
