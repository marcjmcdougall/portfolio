import React, { useState } from "react"
import { Link, graphql } from 'gatsby'
import { GatsbyImage } from "gatsby-plugin-image"
import LayoutStandard from '../../components/layouts/Standard' 

export default function Portfolio({ data }) {

  const [active, setActive] = useState('everything');
  const localFiles = data.allFile.nodes;
	
  return (
    <LayoutStandard>

        <section className="row page-title">

      <div className="container">

            <div className="col-7">

                <h1>Portfolio</h1>

            </div>

      </div>

        </section>

    <section className="row">
      <div className="container">
        <div id="dribbble-cta" className="col-12">
          <div className="text">
            <h2 className="h3">Looking for something specific?</h2>
            <p>Every week I post a new unique redesign over on Dribbble.  Check them out if you want to get a feel for my design style.</p>
            <a className="button" href="https://dribbble.com/marcmcdougall" target="_blank" rel="noopener noreferer">My Dribbble Profile <svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg></a>
          </div>
          <div className="flair">
            <div id="dribbble-cta-flair">
              <div className="dribbble-flair-occluder dribbble-flair-occluder--left"></div>
              <div className="dribbble-flair-occluder dribbble-flair-occluder--right"></div>
              <div className="dribbble-flair-row dribbble-flair-row--first">
                <div className="dribbble-flair-group dribbble-flair-group--a">
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-1').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-2').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-3').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-4').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                </div>
                <div className="dribbble-flair-group dribbble-flair-group--b">
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-1').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-2').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-3').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-4').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                </div>
              </div>
              <div className="dribbble-flair-row dribbble-flair-row--second">
                <div className="dribbble-flair-group dribbble-flair-group--a">
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-5').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-6').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-7').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-8').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                </div>
                <div className="dribbble-flair-group dribbble-flair-group--b">
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-5').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-6').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-7').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--desktop" placeholder="none" alt=""/>
                  <GatsbyImage onLoad={() => {
                                      }} image={localFiles.find(n => n.name == 'portfolio-dribbble-shot-8').childImageSharp.gatsbyImageData} className="dribbble-flair-item dribbble-flair-item--mobile" placeholder="none" alt=""/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="tags" className="row">

      <div className="container">

        <div className="col-12">

          <ul className="tags">

            <li><a className={active === 'everything' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('everything'); console.log(active); }}>Everything</a></li>
            <li><a className={active === 'product-ui' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('product-ui'); console.log(active);}}>Product UI</a></li>
            <li><a className={active === 'marketing-site-ui' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('marketing-site-ui'); console.log(active);}}>Marketing Site</a></li>
            {/*<li><a className={active === 'ecommerce' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('ecommerce'); console.log(active);}}>eCommerce</a></li>*/}
            {/*<li><a className={active === 'experimental' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('experimental'); console.log(active);}}>Experimental</a></li>*/}

          </ul>

        </div>

        </div>

    </section>

        <section className="archive-container">

      <div className="container">

        <div className="row">

                {data.allWpPortfolio.nodes.map((post, i) => (

            <div key={i} className={((post.portfolioCategories.nodes.map(tag => tag.slug).indexOf(active) >= 0) || active === 'everything') ? 'col-12 archive-portfolio active' : 'col-12 archive-portfolio' }>

                    <div className="wrap">
                    
                <Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <GatsbyImage image={post.featuredImage.node.localFile.childImageSharp.gatsbyImageData} alt="" className="bgImage"/> : null }</Link>

                <div className="rightSide">

                  <div className="text">

                    <Link to={'/portfolio/' + post.slug}><h3>{post.portfolioData.projectSimpleTitle}</h3></Link>
                    <p className="meta">{(post.portfolioTags.nodes.length > 0) ? post.portfolioTags.nodes[0].name : ''}</p>
                    <p dangerouslySetInnerHTML={{ __html: post.portfolioData.projectSimpleDescription }}></p>

                  </div>

                  <Link to={'/portfolio/' + post.slug} className="button">Read More</Link>

                </div>

              </div>

            </div>

                ))}

        </div>

      </div>

        </section>

    </LayoutStandard>
  );
}

export const pageQuery = graphql`{
  allWpPortfolio(
    filter: {portfolioData: {showOnHomepage: {eq: true}}}
    sort: {fields: date, order: DESC}
  ) {
    nodes {
      content
      slug
      portfolioTags {
        nodes {
          slug
          name
        }
      }
      portfolioCategories {
        nodes {
          slug
          name
        }
      }
      featuredImage {
        node {
          localFile {
            childImageSharp {
              gatsbyImageData(layout: FULL_WIDTH)
            }
          }
          id
        }
      }
      portfolioData {
        projectSimpleDescription
        projectSimpleTitle
        results
      }
    }
  }
  allFile(filter: {absolutePath: {regex: "/(/dribbble-images)//"}}) {
    nodes {
      relativePath
      name
      childImageSharp {
        gatsbyImageData(layout: FULL_WIDTH)
        fixed(width: 400, height: 400) {
          ...GatsbyImageSharpFixed
        }
      }
    }
  }
}`