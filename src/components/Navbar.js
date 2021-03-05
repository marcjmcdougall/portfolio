import { StaticQuery, graphql, Link } from 'gatsby'
import React from "react"
import Img from "gatsby-image"
import { PopupText } from "react-calendly"

export default function Navbar() {

  return (

      <StaticQuery

        query={graphql`query {
          file(relativePath: {eq: "signature.png"}) {
            childImageSharp {
              fluid(maxWidth: 250) {
                ...GatsbyImageSharpFluid
              }
            }
          }
        }`}

        render={data => (

           <nav id="main-nav" className="container">

            <div className="row">

              <div className="col-3"><Link to="/"><Img fadeIn={false} fluid={data.file.childImageSharp.fluid} alt="Marc McDougall's signature" style={{ maxWidth: '125px' }}/></Link></div>

              <div className="col-9 right">
     
                <ul> 

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
