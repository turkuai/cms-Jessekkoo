<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

  <script>
    // --- GLOBAL MUUTTUJAT ---
    let editHeadingMode = false
    const linksList = JSON.parse(localStorage.getItem("link-list")) || []
    const footerLinksList = JSON.parse(localStorage.getItem("footer-link-list")) || []
    const articlesData = JSON.parse(localStorage.getItem("articles-data")) || []
    const footerData = JSON.parse(localStorage.getItem("footer-data")) || {}

    // --- TITLE EDIT ---
    function handleHeadingEdit() {
      editHeadingMode = !editHeadingMode

      const headingElement = document.getElementById("title")
      const inputElement = document.getElementById("titleInput")

      if (!editHeadingMode) {
        const title = inputElement.value
        headingElement.innerHTML = title
        localStorage.setItem("title", title)
      }

      headingElement.hidden = editHeadingMode
      inputElement.hidden = !editHeadingMode
      document.getElementById("titleButton").innerHTML = editHeadingMode ? "Save" : "Edit"
    }

    // --- ARTICLE TITLE EDIT ---
    function handleArticleTitleEdit(index) {
      const btn = document.getElementById(`articleTitleBtn${index}`)
      const titleEl = document.getElementById(`articleTitle${index}`)
      const inputEl = document.getElementById(`articleTitleInput${index}`)

      const editing = btn.innerHTML === "Edit"
      if (editing) {
        btn.innerHTML = "Save"
        titleEl.hidden = true
        inputEl.hidden = false
      } else {
        btn.innerHTML = "Edit"
        titleEl.hidden = false
        inputEl.hidden = true
        const newTitle = inputEl.value
        titleEl.innerHTML = newTitle

        // Tallenna localStorageen
        articlesData[index] = articlesData[index] || {}
        articlesData[index].title = newTitle
        localStorage.setItem("articles-data", JSON.stringify(articlesData))
      }
    }

    // --- ARTICLE PARAGRAPH EDIT ---
    function handleArticleParagraphEdit(index) {
      const btn = document.getElementById(`articleParaBtn${index}`)
      const paraEl = document.getElementById(`articlePara${index}`)
      const textareaEl = document.getElementById(`articleParaInput${index}`)

      const editing = btn.innerHTML === "Edit"
      if (editing) {
        btn.innerHTML = "Save"
        paraEl.hidden = true
        textareaEl.hidden = false
      } else {
        btn.innerHTML = "Edit"
        paraEl.hidden = false
        textareaEl.hidden = true
        const newText = textareaEl.value
        paraEl.innerHTML = newText

        // Tallenna localStorageen
        articlesData[index] = articlesData[index] || {}
        articlesData[index].paragraph = newText
        localStorage.setItem("articles-data", JSON.stringify(articlesData))
      }
    }

    // --- ARTICLE IMAGE EDIT ---
    function handleArticleImageEdit(index) {
      const btn = document.getElementById(`articleImageBtn${index}`)
      const imgEl = document.getElementById(`articleImage${index}`)
      const inputEl = document.getElementById(`articleImageInput${index}`)

      const editing = btn.innerHTML === "Edit"
      if (editing) {
        btn.innerHTML = "Save"
        imgEl.hidden = true
        inputEl.hidden = false
      } else {
        btn.innerHTML = "Edit"
        imgEl.hidden = false
        inputEl.hidden = true
        const newSrc = inputEl.value
        imgEl.src = newSrc

        // Tallenna localStorageen
        articlesData[index] = articlesData[index] || {}
        articlesData[index].imageSrc = newSrc
        localStorage.setItem("articles-data", JSON.stringify(articlesData))
      }
    }

    // --- FOOTER TITLE EDIT ---
    function handleFooterTitleEdit() {
      const btn = document.getElementById("footerTitleBtn")
      const titleEl = document.getElementById("footerTitle")
      const inputEl = document.getElementById("footerTitleInput")

      const editing = btn.innerHTML === "Edit"
      if (editing) {
        btn.innerHTML = "Save"
        titleEl.hidden = true
        inputEl.hidden = false
      } else {
        btn.innerHTML = "Edit"
        titleEl.hidden = false
        inputEl.hidden = true
        const newTitle = inputEl.value
        titleEl.innerHTML = newTitle

        footerData.title = newTitle
        localStorage.setItem("footer-data", JSON.stringify(footerData))
      }
    }

    // --- FOOTER LINKS EDIT ---
    function handleFooterLinkEdit(index) {
      const btn = document.getElementById(`footerLinkBtn${index}`)
      const linkEl = document.getElementById(`footerLink${index}`)
      const inputName = document.getElementById(`footerLinkNameInput${index}`)
      const inputHref = document.getElementById(`footerLinkHrefInput${index}`)

      const editing = btn.innerHTML === "Edit"
      if (editing) {
        btn.innerHTML = "Save"
        linkEl.hidden = true
        inputName.hidden = false
        inputHref.hidden = false
      } else {
        btn.innerHTML = "Edit"
        linkEl.hidden = false
        inputName.hidden = true
        inputHref.hidden = true

        const newName = inputName.value
        const newHref = inputHref.value
        linkEl.innerHTML = newName
        linkEl.href = newHref

        footerLinksList[index] = { name: newName, href: newHref }
        localStorage.setItem("footer-link-list", JSON.stringify(footerLinksList))
      }
    }

    // --- FOOTER LINK ADD ---
    function handleAddFooterLink(e) {
      const btn = e.target
      const editing = btn.innerHTML === "+"
      const inputName = document.getElementById("footerLinkNameAdd")
      const inputHref = document.getElementById("footerLinkHrefAdd")

      if (editing) {
        btn.innerHTML = "Save"
        inputName.hidden = false
        inputHref.hidden = false
      } else {
        btn.innerHTML = "+"
        inputName.hidden = true
        inputHref.hidden = true

        const newName = inputName.value.trim()
        const newHref = inputHref.value.trim()
        if (newName && newHref) {
          footerLinksList.push({ name: newName, href: newHref })
          localStorage.setItem("footer-link-list", JSON.stringify(footerLinksList))
          renderFooterLinks()
          inputName.value = ""
          inputHref.value = ""
        }
      }
    }

    // --- FOOTER LINKS RENDER ---
    function renderFooterLinks() {
      const container = document.getElementById("footer-links-container")
      container.innerHTML = ""

      footerLinksList.forEach((link, index) => {
        const a = document.createElement("a")
        a.href = link.href
        a.id = `footerLink${index}`
        a.innerHTML = link.name
        a.style.marginRight = "10px"

        // input name
        const inputName = document.createElement("input")
        inputName.type = "text"
        inputName.value = link.name
        inputName.id = `footerLinkNameInput${index}`
        inputName.hidden = true
        inputName.style.marginRight = "5px"

        // input href
        const inputHref = document.createElement("input")
        inputHref.type = "text"
        inputHref.value = link.href
        inputHref.id = `footerLinkHrefInput${index}`
        inputHref.hidden = true
        inputHref.style.marginRight = "5px"

        // edit button
        const btn = document.createElement("button")
        btn.id = `footerLinkBtn${index}`
        btn.innerHTML = "Edit"
        btn.onclick = () => handleFooterLinkEdit(index)

        const wrapper = document.createElement("div")
        wrapper.style.marginBottom = "5px"
        wrapper.appendChild(a)
        wrapper.appendChild(inputName)
        wrapper.appendChild(inputHref)
        wrapper.appendChild(btn)

        container.appendChild(wrapper)
      })
    }

    // --- ARTICLES RENDER ---
    function renderArticles() {
      const main = document.querySelector("main")
      main.innerHTML = "" // tyhjennä

      // Jos tallennettu data on tyhjä, tehdään 2 oletusartikkelia kuten alkuperäisessä
      if (articlesData.length === 0) {
        articlesData.push(
          {
            title: "A title for article",
            paragraph: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus magna sit amet lorem ultricies, aliquam molestie libero pharetra. Curabitur cursus auctor lacus quis molestie.",
            imageSrc: ""
          },
          {
            title: "A title for article",
            paragraph: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse finibus magna sit amet lorem ultricies, aliquam molestie libero pharetra. Curabitur cursus auctor lacus quis molestie.",
            imageSrc: ""
          }
        )
      }

      articlesData.forEach((article, index) => {
        const articleEl = document.createElement("article")

        // Otsikko
        const h2 = document.createElement("h2")
        h2.id = `articleTitle${index}`
        h2.innerHTML = article.title

        const titleInput = document.createElement("input")
        titleInput.type = "text"
        titleInput.id = `articleTitleInput${index}`
        titleInput.value = article.title
        titleInput.hidden = true

        const titleBtn = document.createElement("button")
        titleBtn.id = `articleTitleBtn${index}`
        titleBtn.innerHTML = "Edit"
        titleBtn.onclick = () => handleArticleTitleEdit(index)

        // Kappale
        const contentDiv = document.createElement("div")
        contentDiv.className = "content"

        const p = document.createElement("p")
        p.id = `articlePara${index}`
        p.innerHTML = article.paragraph

        const paraInput = document.createElement("textarea")
        paraInput.id = `articleParaInput${index}`
        paraInput.value = article.paragraph
        paraInput.hidden = true
        paraInput.style.width = "100%"
        paraInput.style.height = "100px"

        const paraBtn = document.createElement("button")
        paraBtn.id = `articleParaBtn${index}`
        paraBtn.innerHTML = "Edit"
        paraBtn.onclick = () => handleArticleParagraphEdit(index)

        // Kuva
        const imgPlaceholder = document.createElement("div")
        imgPlaceholder.className = "image-placeholder"

        const img = document.createElement("img")
        img.id = `articleImage${index}`
        img.src = article.imageSrc || "https://via.placeholder.com/300x150?text=No+Image"
        img.style.maxWidth = "100%"
        imgPlaceholder.appendChild(img)

        const imgInput = document.createElement("input")
        imgInput.type = "text"
        imgInput.id = `articleImageInput${index}`
        imgInput.value = article.imageSrc || ""
        imgInput.hidden = true
        imgInput.placeholder = "Image URL"

        const imgBtn = document.createElement("button")
        imgBtn.id = `articleImageBtn${index}`
        imgBtn.innerHTML = "Edit"
        imgBtn.onclick = () => handleArticleImageEdit(index)

        // Lisätään elementit artikkeliin
        articleEl.appendChild(h2)
        articleEl.appendChild(titleInput)
        articleEl.appendChild(titleBtn)

        contentDiv.appendChild(p)
        contentDiv.appendChild(paraInput)
        contentDiv.appendChild(paraBtn)

        contentDiv.appendChild(imgPlaceholder)
        contentDiv.appendChild(imgInput)
        contentDiv.appendChild(imgBtn)

        articleEl.appendChild(contentDiv)

        main.appendChild(articleEl)
      })
    }

    // --- FOOTER RENDER ---
    function renderFooter() {
      const footerTitleEl = document.getElementById("footerTitle")
      const footerTitleInput = document.getElementById("footerTitleInput")
      const footerTitleBtn = document.getElementById("footerTitleBtn")

      footerTitleEl.innerHTML = footerData.title || "Your company's name"
      footerTitleInput.value = footerData.title || "Your company's name"
      footerTitleBtn.innerHTML = "Edit"

      renderFooterLinks()
    }

    // --- LOAD FUNCTION ---
    function handleLoad() {
      // Title
      const title = localStorage.getItem("title") || "Your Website Title"
      document.getElementById("title").innerHTML = title
      document.getElementById("titleInput").value = title

      renderArticles()
      renderFooter()
    }

    window.addEventListener("load", handleLoad)

  </script>

</head>
<body>
  <div class="header">
    <div id="title" class="logo"></div>
    <input id="titleInput" hidden>
    <button id="titleButton" onclick="handleHeadingEdit()">Edit</button>
    <div class="nav">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Blog</a>
    </div>
  </div>

  <main>
    <!-- Artikkeleita lisätään JS:llä -->
  </main>

  <div class="footer">
    <div class="company-info">
      <h2 id="footerTitle"></h2>
      <input id="footerTitleInput" hidden>
      <button id="footerTitleBtn" onclick="handleFooterTitleEdit()">Edit</button>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
      <p style="font-size: 15px;">@2025, Company's name, All rights reserved.</p>
    </div>

    <div id="footer-links-container" class="footer-links2">
      <!-- Footer linkkejä lisätään JS:llä -->
    </div>

    <input id="footerLinkHrefAdd" placeholder="URL" hidden>
    <input id="footerLinkNameAdd" placeholder="Name" hidden>
    <button onclick="handleAddFooterLink(event)">+</button>
  </div>
</body>
</html>
