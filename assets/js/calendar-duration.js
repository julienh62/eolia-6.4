let mediaQuery = window.matchMedia("(max-width: 1000px)");
let calendar;
//console.log("coucou duration")

function updateCalendarDuration() {
    //console.log("Media query change event:", mediaQuery.matches);
    if (calendar && mediaQuery.matches) {
        // The media query is active (phone mobile screen)
     //   console.log("CategoryColorSetting calendar duration to 3 days");
        calendar.setOption('duration', { days: 3 });
    } else if (calendar) {
        // The media query is not active (large screen)
      //  console.log("CategoryColorSetting calendar duration to 7 days");
        calendar.setOption('duration', { days: 7 });
    }
}

// Call the function once when the page loads
window.addEventListener('load', () => {
    //console.log("Page loaded");
    updateCalendarDuration();
});

// Listen for the 'change' event on the media query
mediaQuery.addEventListener('change', () => {
   // console.log("Media query changed");
    updateCalendarDuration();
});