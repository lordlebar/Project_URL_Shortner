<footer class="p-0">
    <div class="text-center mt-3">
        <h6>© 2022 - 2023 | URL Shortener | Projet Web S3 </h6>
        <a class="text-reset fw-bold" href="http://corentin.lebarilier.13h37.io/Projet_Lamp_EXP2">corentin.lebarilier.13h37.io/Projet_Lamp_EXP2</a>
        <p style='font-size: 12px'>
            Quentin GUYOT · Theo BILLET · Adrienne-Louise TCHAMGOUE · Xavier KOUASSI · Corentin LEBARILIER
        </p>
    </div>
</footer>

<!-- script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js" integrity="sha512-f8mwTB+Bs8a5c46DEm7HQLcJuHMBaH/UFlcgyetMqqkvTcYg4g5VXsYR71b3qC82lZytjNYvBj2pf0VekA9/FQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/@barba/core"></script>

<script>
    document.querySelectorAll(".nav-link").forEach((link) => {
        if (link.href === window.location.href) {
            link.setAttribute("aria-current", "page");

        } else if (link.href + "index.php" === window.location.href) {
            link.setAttribute("aria-current", "page");
        }
    });

    var theme = getCookie("theme");
    var body = document.getElementsByTagName("body")[0];

    if (theme !== "") {
        body.classList.add(theme);
    }

    // enregistrement du theme dans le cookie
    function setCookie(name, value) {
        var d = new Date();
        d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
        var expires = "expires=" + d.toUTCString();
        //console.log(expires)
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
        //console.log(document.cookie)
    }

    // methode de recuperation du theme dans le cookie
    function getCookie(cname) {
        var theme = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === " ") {
                c = c.substring(1);
            }
            if (c.indexOf(theme) === 0) {
                return c.substring(theme.length, c.length);
            }
        }
        return "";
    }

    const changeTheme = () => {
        const body = document.body;
        const btn_toggle = document.getElementsByClassName("btn-toggle");
        if (body.classList.contains("dark")) {
            body.classList.add("light");
            body.classList.remove("dark");
            // value de btn toggle a light
            btn_toggle[0].setAttribute("value", "light");
            setCookie("theme", "light");
        } else if (body.classList.contains("light")) {
            body.classList.add("dark");
            body.classList.remove("light");
            btn_toggle[0].setAttribute("value", "dark");
            setCookie("theme", "dark");
        }
    };
</script>


<!-- <script>
    // animation de chargement
    const AllBands = document.querySelectorAll(".band");

    // pour eviter le flash de la page avant l'animation mettre le height de toutes les bandes a 100% dans le css !!

    const TLAnim = new TimelineMax();

    function delay(n) {
        return new Promise((done) => {
            setTimeout(() => {
                done();
            }, n);
        });
    }

    barba.init({
        sync: true,
        transitions: [{
            async leave() {
                const done = this.async();
                TLAnim.to(AllBands, {
                    height: "100%",
                    stagger: 0.05,
                    duration: 0.3,
                });

                await delay(250);
                done();
            },

            async enter() {
                // reload page
                window.location.reload();
            },
        }, ],
    });

    // page load animation
    window.addEventListener("DOMContentLoaded", () => {
        TLAnim
            .to(AllBands, {
                height: "100%",
            }).to(AllBands, {
                height: "0%",
                stagger: 0.05,
                duration: 0.3,
            });
    });
</script> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>