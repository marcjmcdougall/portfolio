import React from 'react'
import Navbar from '../Navbar'
import SEO from '../SEO'
import '../../styles/global.css'

export default function LayoutStandard({children}){
	
  return (

  		<div className="layout layout-standard">

        <SEO />

        <Navbar/>

        <main className="content">

            { children }

        </main>

        <footer>

          <div className="container">

            <div className="row">

              <div className="col-12">

                <p>© {(new Date().getFullYear())} Kilobyte Studios, LLC.</p>

              </div>

            </div>

          </div>

        </footer>

      </div>
  	)
}
