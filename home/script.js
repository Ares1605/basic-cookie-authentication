let content_span_eles = document.querySelectorAll(".contents span");
const set_content = (span_ele) => {
  content_span_eles.forEach(ele => ele.classList.remove("active"));
  span_ele.classList.add("active");
}

content_span_eles.forEach(ele => {
  ele.addEventListener("click", () => {
    set_content(ele);
  });
});

set_content(content_span_eles[0]);
