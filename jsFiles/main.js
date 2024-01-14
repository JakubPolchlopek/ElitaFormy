document.addEventListener('DOMContentLoaded', () => {
    pageLoaderControler(() => {
        setInterval(typeText, 150)
    })
})

const pageLoaderControler = (callback) => {
    const pageLoader = document.querySelector('.page-loader')
    pageLoader.classList.add('hidden')
    setTimeout(() => {
        pageLoader.remove()
        document.querySelector('body').style.overflow = 'auto'
        callback()
    }, 1000)
}

const randomText = document.querySelector('.random-text')
const textArray = [
    "W elitarnej formie, każdy trening jest wyjątkowy", 
    "Elitaformy - twój klucz do perfekcji ciała i ducha", 
    "Tworzymy wspólnie elitę formy i zdrowego stylu życia", 
    "Siła, zdowie, duma - to wszystko u nas",
    "Z nami forma staje się elitarą",
    "Kształtuj elitarną siłę i formę z elitarna determinacją",
    "Twórz z nami elitarne rzeczy",
    "Wspólnie kształtujemy elitarne historie formy - dołącz do nas!",
    "Sprawimy, że twój elitarny potencjał przekształci się w elitarne wyniki",
    "Twoja elitarana forma zaczyna się tu, w naszym królestwie treningu"
]
let stringIndex = 0
let charIndex = 0
let isTyping = true
const typeText = () => {
    if (stringIndex < textArray.length) {
        const currentString = textArray[stringIndex]
        if (isTyping) {
            if (charIndex < currentString.length) {
                
                randomText.textContent += currentString.charAt(charIndex)
                charIndex++
            } else {
                isTyping = false
            }
        } else {
            if (charIndex > 0) {
                randomText.textContent = currentString.substring(0, charIndex - 1)
                charIndex--
            } else {
                isTyping = true
                stringIndex++

                if (stringIndex >= textArray.length) {
                    stringIndex = 0
                }

                charIndex = 0
                randomText.textContent = ''
            }
        }
    }
    randomText.classList.add("motivation-text")
}
