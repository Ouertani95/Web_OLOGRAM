FROM continuumio/miniconda3:latest

WORKDIR /pygtftk

# Configure conda environment
RUN conda config --add channels defaults && \
    conda config --add channels bioconda && \
    conda config --add channels conda-forge && \
    conda init --all && \
    conda create -n pygtftk pygtftk
    #conda activate pygtftk

CMD ["conda", "run", "-n", "pygtftk", "gtftk", "get_example", "-q", "-d", "simple", "-f", "*", "&&", "ls"] 
