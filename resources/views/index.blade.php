<!doctype html>
<html lang="en">
@include('includes.head')

<body>
  @include('includes.navigation')
  <div class="full-page-wrapper">
    <div id="hero">

      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div id="site-intro">
              <h1>Izvēlies, pārbaudi, saliec!</h1>
              <p>“Saliec Kompi” nodrošina datoru detaļu izvēli un automātisku savienojamības pārbaudi, jebkuram, kas vēlas pats
                sakomplektēt savu unikālo datoru.
              </p>
              <a class="button button-primary" href="saliec-pats">Sākt tagad</a>

              <div id="down-arrow">
                <i class="fa fa-chevron-down"></i>
              </div>
            </div>
            <!-- end of div site intro-->
          </div>
          <!-- end of div twelve columns-->
        </div>
        <!--- end of div row -->
      </div>
      <!--- end of div container -->
    </div>
    <!-- end of div hero -->


    <div id="intro-feature">
      <div class="container">
        <div class="row">

          <div class="four columns">
            <section class="features">
              <i class="fa fa-wrench"></i>

              <h5>Savienojamības pārbaude</h5>
              <p>"Loremipsumdolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation"</p>

            </section>
          </div>
          <!-- end of div four columns -->

          <div class="four columns">
            <section class="features">
              <i class="fa fa-money" aria-hidden="true"></i>

              <h5>Izdevīgākās cenas</h5>
              <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>

            </section>
          </div>
          <!-- end of div four columns -->

          <div class="four columns">
            <section class="features">
              <i class="fa fa-compass" aria-hidden="true"></i>

              <h5>Plašs detaļu klāsts</h5>
              <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>

            </section>
          </div>
          <!-- end of div four columns -->
        </div>
        <!-- end of div row -->
      </div>
      <!--- end of div container -->
    </div>
    <!-- end of div intro-feature -->
  </div>
  <!-- end of div row -->
  </div>
  <!--- end of div container -->
  </div>
  <!-- end of div guides-wrapper -->
  @include('includes.footer')
  </div>
</body>

</html>