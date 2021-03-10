import { StaticQuery, graphql, Link } from 'gatsby'
import React, { useState } from "react"
import Img from "gatsby-image"
import { PopupText } from "react-calendly"

export default function Navbar() {

  const [open, setOpen] = useState(false);

  return (

      <StaticQuery

        query={graphql`query {
          file(relativePath: {eq: "signature.jpg"}) {
            childImageSharp {
              fluid(maxWidth: 200) {
                ...GatsbyImageSharpFluid
              }
            }
          }
        }`}

        render={data => (

           <nav id="main-nav" className="container">

            <div className="row">

              <div className="col-3"><Link to="/"><Img fluid={data.file.childImageSharp.fluid} alt="Marc McDougall's signature" style={{ maxWidth: '160px' }}/></Link></div>

              <div className="col-9 right">
                
                <a href="#" className="toggler" onClick = {()=>setOpen(!open)}><span/><span/><span/></a>

                <ul className='desktopMenu'> 

                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/hello" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

            <div class="row">
                
             <div className="col-12">
                
                <ul open={open} className= {'mobileMenu ' + (open ? 'open' : 'closed')}> 

                  <li><Link to="/">Home</Link></li>
                  <li><Link to="/portfolio">Portfolio</Link></li>
                  <li><Link to="/testimonials">Testimonials</Link></li>
                  <li className="schedule"><PopupText url="https://calendly.com/kbs-marc/strategy-call" text="Let's Talk"></PopupText></li>

                </ul>

              </div>

            </div>

          </nav>
        )}
      />
  	)
}
