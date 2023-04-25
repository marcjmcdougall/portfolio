import React from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../components/layouts/Standard'

export default function Testimonials({ data }) {

	// console.log(data);

  return (

  		<LayoutStandard>

	  		<section className="row page-title">

	  			<div className="container">

		  			<div className="col-7">

		  				<h1>Testimonials</h1>

		  			</div>

	  			</div>

	  		</section>

	  		<section className="row archive-container">

			  		<div className="container">

		            <div className="row">

			  			{data.allWpTestimonial.nodes.map(function(node, index){

			  				return (

			  					<div className="col-12 archive-testimonial">
					  				<p dangerouslySetInnerHTML={{ __html: '\"' + node.testimonialData.testimonial + '\"' }}></p>

					  				{node.testimonialData.profileImage ? <Img fluid={node.testimonialData.profileImage.localFile.childImageSharp.fluid}/> : null }

							        <div className="text-content">
							          <h4>{node.title}</h4>
							          <p>{node.testimonialData.siteName}</p>
							        </div>
							    </div>
							    )

					      })}

			  			</div>

			  		</div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const pageQuery = graphql`
 query MyQuery {
  allWpTestimonial(sort: {fields: date, order: DESC}) {
    nodes {
      id
      title
      testimonialData {
        siteName
        testimonial
        profileImage {
          localFile {
            childImageSharp {
              fluid {
                ...GatsbyImageSharpFluid
              }
            }
          }
        }
      }
    }
  }
}`