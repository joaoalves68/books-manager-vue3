<template>
  <div>
    <!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Books Manager</title>
        </head>
        <body class="d-flex flex-column min-vh-100">
          <div class="d-flex flex-grow-1" id="wrapper">
            <div id="page-content-wrapper" class="flex-grow-1">
              <div class="container-fluid">
                <router-view></router-view>
              </div>
            </div>
          </div>

        </body>
      </html>

  </div>
</template>