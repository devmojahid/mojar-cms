import{a,j as l}from"./app-aac88db0.js";function n(e={type:"text",required:!1,class:""}){return a("div",{className:"form-group",children:[a("label",{className:"col-form-label",htmlFor:e.id,children:[e.label||e.name,e.required?l("abbr",{children:"*"}):""]}),l("input",{type:e.type,name:e.name,className:`form-control ${e.class||""}`,id:e.id,defaultValue:e.value,autoComplete:"off",placeholder:e.placeholder,required:e.required,onBlur:e.onBlur}),e.description&&l("small",{className:"form-text text-muted",dangerouslySetInnerHTML:{__html:e.description}})]})}export{n as I};