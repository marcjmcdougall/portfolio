import React from "react"
import Navbar from '../Navbar'

export default function LayoutStandard({ children }) {
	
  return (

  		<div class="layout layout-standard">

        <Navbar/>

        <div class="content">
          
          { children }

        </div>

        <footer>

          <p>© 2016 — 2021 Kilobyte Studios, LLC.</p>

        </footer>

  		</div>
  	)
}
