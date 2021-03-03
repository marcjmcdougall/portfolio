import React from "react"
import Navbar from '../Navbar'
import '../../styles/global.css'

export default function LayoutStandard({ children }) {
	
  return (

  		<div className="layout layout-standard">

        <Navbar/>

        <main className="content container">

            { children }

        </main>

        <footer>

          <div className="container">

            <div className="row">

              <div className="col-12">

                <p>© 2016 — 2021 Kilobyte Studios, LLC.</p>

              </div>

            </div>

          </div>

        </footer>

      </div>
  	)
}
