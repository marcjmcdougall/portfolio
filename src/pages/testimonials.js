import React from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../components/layouts/Standard'

export default function Testimonials({ data }) {

	// console.log(data);

  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>Testimonials</h1>

	  			</div>

	  		</section>

	  		<section className="row archive-container">

	  			{data.allWpTestimonial.edges.map(function(node, index){

	  				return (

	  					<div className="col-6 archive-testimonial">
			  				<p dangerouslySetInnerHTML={{ __html: node.node.testimonials.testimonial }}></p>

			  				{node.node.testimonials.profileImage ? <Img fluid={node.node.testimonials.profileImage.localFile.childImageSharp.fluid}/> : null }

					        <div className="text-content">
					          <h3>{node.node.title}</h3>
					          <p>{node.node.testimonials.siteName}</p>
					        </div>
					    </div>
					    )

			      })}

	  		</section>

  		</LayoutStandard>
  	)
}

export const pageQuery = graphql`
 query MyQuery {
  allWpTestimonial(sort: { fields: [date], order: DESC }){
    edges {
      node {
        id
        title
        testimonials {
          siteName
          testimonial
          profileImage {
            localFile {
              childImageSharp {
                fluid (maxWidth: 50){
                  ...GatsbyImageSharpFluid
                }
              }
            }
          }
        }
      }
    }
  }
}`