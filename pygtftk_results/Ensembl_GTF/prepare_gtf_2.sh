# Retrieve homo_sapiens GTF from Ensembl (GRCh38 - release 106).
# Ensure proper format (convert_ensembl).
# Prefix chromosomes with 'chr' (-C)
# Only keep chromosome 1-22 and X/Y (select_by_regexp)

mkdir -p GTF
cd GTF
conda run --no-capture-output  -n pygtftk gtftk retrieve -s homo_sapiens -r 106 -cd -V 2|conda run --no-capture-output  -n pygtftk gtftk convert_ensembl -C -V 2 |conda run --no-capture-output  -n pygtftk gtftk select_by_regexp  -V 2 > Homo_sapiens.GRCh38.106.chr.gtf


# Retrieve homo_sapiens GTF from Ensembl (GRCh37 - release 106 which corresponds in fact
# to release 87).
# Ensure proper format (convert_ensembl).
# Prefix chromosomes with 'chr' (-C)
# Only keep chromosome 1-22 and X/Y (select_by_regexp) 

wget http://ftp.ensembl.org/pub/grch37/release-106/gtf/homo_sapiens/Homo_sapiens.GRCh37.87.chr.gtf.gz
conda run --no-capture-output  -n pygtftk gtftk convert_ensembl -C -V 2 -i Homo_sapiens.GRCh37.87.chr.gtf.gz |conda run --no-capture-output  -n pygtftk gtftk select_by_regexp  -V 2 -o Homo_sapiens.GRCh37.87.chr.gtf


# Retrieve Mus musculus GTF from Ensembl (GRCh39 - release 106)
# Ensure proper format (convert_ensembl).
# Prefix chromosomes with 'chr' (-C)
# Only keep chromosome 1-19 and X/Y (select_by_regexp)
conda run --no-capture-output  -n pygtftk gtftk retrieve -s mus_musculus -r 106 -cd -V 2|conda run --no-capture-output  -n pygtftk  gtftk convert_ensembl -C -V 2 |conda run --no-capture-output  -n pygtftk gtftk select_by_regexp  -V 2 > Mus_musculus.GRCm39.106.chr.gtf

# Retrieve Mus musculus GTF from Ensembl (GRCh38 - release 102)
# Ensure proper format (convert_ensembl).
# Prefix chromosomes with 'chr' (-C)
# Only keep chromosome 1-19 and X/Y (select_by_regexp)

conda run --no-capture-output  -n pygtftk gtftk retrieve -s mus_musculus -r 102 -cd -V 2|conda run --no-capture-output  -n pygtftk  gtftk convert_ensembl -C -V 2 |conda run --no-capture-output  -n pygtftk   gtftk select_by_regexp  -V 2 > Mus_musculus.GRCm38.102.chr.gtf

# Retrieve Mus musculus GTF from Ensembl (NCBIM37 - release 67)
# Ensure proper format (convert_ensembl).
# Prefix chromosomes with 'chr' (-C)
# Only keep chromosome 1-19 and X/Y (select_by_regexp)

conda run --no-capture-output  -n pygtftk gtftk retrieve -s mus_musculus -r 67 -cd -V 2|conda run --no-capture-output  -n pygtftk  gtftk convert_ensembl -C -V 2 |conda run --no-capture-output  -n pygtftk   gtftk select_by_regexp  -V 2 > Mus_musculus.NCBIM37.67.gtf

rm -f *gz

cd ../
mkdir -p chr_size
cd chr_size
# Retrieve human chromosome length
# hg38 / GRCh38

curl https://hgdownload.soe.ucsc.edu/goldenPath/hg38/database/chromInfo.txt.gz | gunzip -c | cut -f1,2 | perl -ne 'print if(/^chr[0-9XY]+\t/)' > GRCh38_chr_size.txt

# hg19 / GRCh37

curl https://hgdownload.soe.ucsc.edu/goldenPath/hg19/database/chromInfo.txt.gz | gunzip -c | cut -f1,2 | perl -ne 'print if(/^chr[0-9XY]+\t/)' > GRCh37_chr_size.txt


# Retrieve mouse chromosome length
# mm9 / NCBIM37

curl https://hgdownload.soe.ucsc.edu/goldenPath/mm9/database/chromInfo.txt.gz | gunzip -c | cut -f1,2 | perl -ne 'print if(/^chr[0-9XY]+\t/)' > NCBIM37_chr_size.txt

# mm10 / GRCm38
curl https://hgdownload.soe.ucsc.edu/goldenPath/mm10/database/chromInfo.txt.gz | gunzip -c | cut -f1,2 | perl -ne 'print if(/^chr[0-9XY]+\t/)' > GRCm38_chr_size.txt

# mm39 / GRCm39
curl https://hgdownload.soe.ucsc.edu/goldenPath/mm39/database/chromInfo.txt.gz | gunzip -c | cut -f1,2 | perl -ne 'print if(/^chr[0-9XY]+\t/)' > GRCm39_chr_size.txt


