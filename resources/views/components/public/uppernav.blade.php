<!--  Font Awesome (icons)  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!--  UPPER NAVBAR  -->
<div id="topbar" class="bg-transparent text-white border-b border-white relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between py-2 space-y-2 sm:space-y-0">
            <!--  LEFT : contact  -->
            <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm">
                <div class="flex items-center space-x-1">
                    <i class="fas fa-envelope text-white text-xs"></i>
                    <span>pustipd@radenfatah.ac.id</span>
                </div>

                <span class="hidden sm:inline-block w-px h-4 bg-white"></span>

                <div class="flex items-center space-x-1">
                    <i class="fas fa-map-marker-alt text-white text-xs"></i>
                    <span>Perpustakaan Lt. 4 Kampus B UIN RF Jakabaring</span>
                </div>
            </div>

            <!--  RIGHT : social + clock  -->
            <div class="flex items-center space-x-4">
                <!--  divider  -->
                <span class="hidden sm:inline-block w-px h-4 bg-white"></span>

                <!--  real-time WIB clock & status  -->
                <div class="flex items-center space-x-1 text-xs sm:text-sm">
                    <i class="fas fa-clock text-white text-xs"></i>
                    <span id="open-status" class="font-semibold uppercase"></span>
                    <span id="clock"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const days = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
        ];
        const months = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Mei",
            "Jun",
            "Jul",
            "Agu",
            "Sep",
            "Okt",
            "Nov",
            "Des",
        ];

        function updateClock() {
            const now = new Date();
            // force to Asia/Jakarta (WIB, UTC+7)
            const jakarta = new Date(
                now.toLocaleString("en-US", {
                    timeZone: "Asia/Jakarta"
                })
            );

            const dayIdx = jakarta.getDay();
            const hr = jakarta.getHours();
            const min = jakarta.getMinutes();

            // open hours: Mon-Fri, 08:00-15:59
            const isOpen =
                dayIdx >= 1 && dayIdx <= 5 && hr >= 8 && (hr < 16 || (hr === 16 && min === 0));

            // text pieces
            const status = isOpen ? "BUKA," : "TUTUP,";
            const dayName = days[dayIdx];
            const day = jakarta.getDate().toString().padStart(2, "0");
            const month = months[jakarta.getMonth()];
            const year = jakarta.getFullYear();
            const time = `${hr.toString().padStart(2, "0")}.${min
        .toString()
        .padStart(2, "0")} WIB`;

            // render
            document.getElementById("open-status").textContent = status;
            document.getElementById(
                "clock"
            ).textContent = ` ${dayName}, ${day} ${month} ${year} (${time})`;
        }

        updateClock(); // initial
        setInterval(updateClock, 60_000); // update every minute
    })();
</script>
