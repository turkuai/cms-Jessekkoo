<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

  <script>
    function handleLoad() {
      // Lataa title
      const title = localStorage.getItem("title") || "Your Website Title"
      document.getElementById("title").innerHTML = title

      // Lataa artikkelit
      const articlesData = JSON.parse(localStorage.getItem("articles-data")) || [
        {
          title: "A title for article",
          paragraph: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus magna sit amet lorem ultricies, aliquam molestie libero pharetra.",
          imageSrc: ""
        },
        {
          title: "A title for article",
          paragraph: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus magna sit amet lorem ultricies, aliquam molestie libero pharetra.",
          imageSrc: ""
        }
      ]

      const main = document.querySelector("main")
      articlesData.forEach(article => {
        const articleEl = document.createElement("article")

        const h2 = document.createElement("h2")
        h2.innerHTML = article.title

        const contentDiv = document.createElement("div")
        contentDiv.className = "content"

        const p = document.createElement("p")
        p.innerHTML = article.paragraph

        const imgPlaceholder = document.createElement("div")
        imgPlaceholder.className = "image-placeholder"
        const img = document.createElement("img")
        img.src = article.imageSrc || "https://via.placeholder.com/300x150?text=No+Image"
        img.style.maxWidth = "100%"
        imgPlaceholder.appendChild(img)

        contentDiv.appendChild(p)
        contentDiv.appendChild(imgPlaceholder)

        articleEl.appendChild(h2)
        articleEl.appendChild(contentDiv)

        main.appendChild(articleEl)
      })

      // Footer otsikko
      const footerData = JSON.parse(localStorage.getItem("footer-data")) || {}
      document.getElementById("footerTitle").innerHTML = footerData.title || "Your company's name"

      // Footer linkit
      const footerLinksList = JSON.parse(localStorage.getItem("footer-link-list")) || [
        {name:"Facebook", href:"#"},
        {name:"LinkedIn", href:"#"},
        {name:"GitHub", href:"#"}
      ]

      const container = document.getElementById("footer-links-container")
      footerLinksList.forEach(link => {
        const a = document.createElement("a")
        a.href = link.href
        a.innerHTML = link.name
        a.style.marginRight = "10px"
        container.appendChild(a)
      })
    }

    window.addEventListener("load", handleLoad)
  </script>

</head>
<body>
  <div class="header">
    <div id="title" class="logo"></div>
    <div class="nav">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Blog</a>
</div>

</div> <main> <!-- Artikkeleita lisätään JS:llä --> </main> <div class="footer"> <div class="company-info"> <h2 id="footerTitle"></h2> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p> <p style="font-size: 15px;">@2025, Company's name, All rights reserved.</p> </div>

<div id="footer-links-container" class="footer-links2">
  <!-- Footer linkkejä lisätään JS:llä -->
</div>
</div> </body> </html>