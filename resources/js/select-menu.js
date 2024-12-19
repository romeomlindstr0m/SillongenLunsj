document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector("button[aria-haspopup='listbox']");
    const dropdown = document.querySelector("ul[role='listbox']");
    const options = dropdown.querySelectorAll("li[role='option']");
    const buttonLabel = button.querySelector("span.truncate");
  
    let selectedOptionIndex = 0;
    let isOpen = false;
  
    const toggleDropdown = (show) => {
      isOpen = typeof show === "boolean" ? show : !isOpen;
      dropdown.style.display = isOpen ? "block" : "none";
      button.setAttribute("aria-expanded", isOpen.toString());
      if (isOpen) dropdown.focus();
    };
  
    const updateSelectedOption = (index) => {
      options[selectedOptionIndex].classList.remove("bg-indigo-600", "text-white");
      options[selectedOptionIndex].classList.add("text-gray-900");
  
      selectedOptionIndex = index;
  
      options[selectedOptionIndex].classList.add("bg-indigo-600", "text-white");
      options[selectedOptionIndex].classList.remove("text-gray-900");
    };
  
    const hiddenInput = document.querySelector(".select-input");

    const selectOption = (index) => {
      const selectedOption = options[index];
      const selectedText = selectedOption.querySelector("span.truncate").innerText;
      const selectedValue = parseInt(selectedOption.dataset.value, 10);
      
      buttonLabel.innerText = selectedText;

      hiddenInput.value = selectedValue;
  
      dropdown.setAttribute("aria-activedescendant", selectedOption.id);
  
      toggleDropdown(false);
    };
  
    button.addEventListener("click", () => toggleDropdown());
    button.addEventListener("keydown", (event) => {
      if (event.key === "ArrowDown" || event.key === "ArrowUp") {
        event.preventDefault();
        toggleDropdown(true);
      }
    });
  
    dropdown.addEventListener("keydown", (event) => {
      if (event.key === "ArrowDown") {
        event.preventDefault();
        const nextIndex = (selectedOptionIndex + 1) % options.length;
        updateSelectedOption(nextIndex);
      } else if (event.key === "ArrowUp") {
        event.preventDefault();
        const prevIndex = (selectedOptionIndex - 1 + options.length) % options.length;
        updateSelectedOption(prevIndex);
      } else if (event.key === "Enter") {
        event.preventDefault();
        selectOption(selectedOptionIndex);
      } else if (event.key === "Escape") {
        toggleDropdown(false);
      }
    });
  
    options.forEach((option, index) => {
      option.addEventListener("click", () => {
        selectOption(index);
      });
  
      option.addEventListener("mouseenter", () => {
        updateSelectedOption(index);
      });
    });
  
    document.addEventListener("click", (event) => {
      if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        toggleDropdown(false);
      }
    });
  
    updateSelectedOption(selectedOptionIndex);
  });  